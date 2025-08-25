<?php

namespace App\Livewire\Csv;

use App\Livewire\Forms\DonatorForm;
use App\Livewire\Forms\TransactionForm;
use App\Models\Donator;
use App\Models\Fund;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCsv extends Component
{
    use WithFileUploads;

    public $form = ['csvFile' => null];
    public TransactionForm $transactionForm;

    public $showDonatorForm = false;
    public $showFundForm = false;

    public $name, $iban, $address, $type, $newFundName;
    public $existingFunds = [];
    public string $filePath;

    public $pendingRecords = [];
    public $currentRecord = null;
    public $totalRecords = 0;
    public $processedRecords = 0;
    public $multipleDonators = [];
    public $showMultipleDonatorsModal = false;
    public $currentDonator = null;

    private $fundsCache = null;
    private $generalFundId = 1; // ID du fond général par défaut

    public function import()
    {
        $this->validate([
            'form.csvFile' => 'required|mimes:csv,txt|max:2048',
        ]);

        $uploadedFile = $this->form['csvFile'];
        $this->filePath = $uploadedFile->store('temp');

        $this->processCsv(Storage::path($this->filePath));
    }

    private function processCsv(string $filePath)
    {
        $csv = Reader::createFromPath($filePath)->select(0, 2, 3, 5, 6, 8);
        $records = $csv->getRecords(['date', 'amount', 'IBAN', 'name', 'adresse', 'description']);

        $this->initFundsCache();
        foreach ($records as $key => $record) {
            $hash = md5(json_encode($record));
            if (Transaction::where('hash', $hash)->exists()) {
                continue;
            }
            $fundId = $this->detectFundFromDescription($record['description'] ?? '');
            if ($this->currentDonator) {
                $donator = $this->currentDonator;
                $this->currentDonator = null;
            } else {
                $donator = $this->checkDonator($record);
            }
            if (!$donator) {
                $this->currentRecord = $record;
                break;
            }

            $this->createTransaction($record, $donator, $fundId, $hash);
            $this->processedRecords++;
        }
    }

    private function detectFundFromDescription(string $description): int
    {
        if (empty($description)) {
            return $this->generalFundId;
        }

        $normalizedDescription = $this->normalizeString($description);

        foreach ($this->fundsCache as $fund) {
            $normalizedFundName = $this->normalizeString($fund->title);

            if (str_contains($normalizedDescription, $normalizedFundName)) {
                return $fund->id;
            }

            if (str_contains($fund->title, ' ')) {
                $keywords = explode(' ', $normalizedFundName);
                $matchCount = 0;

                foreach ($keywords as $keyword) {
                    if (strlen($keyword) >= 3 && str_contains($normalizedDescription, $keyword)) {
                        $matchCount++;
                    }
                }

                if ($matchCount > 0 && ($matchCount / count($keywords)) >= 0.7) {
                    return $fund->id;
                }
            }
        }
        return $this->generalFundId;
    }

    private function normalizeString(string $str): string
    {
        return str($str)
            ->lower()
            ->ascii()
            ->squish()
            ->value();
    }

    private function initFundsCache()
    {
        $this->fundsCache = Fund::all();
        if (!$this->fundsCache->where('id', $this->generalFundId)->first()) {
            $this->generalFundId = $this->fundsCache->first()->id;
        }
    }

    private function createTransaction(array $record, $donator, int $fundId, $hash)
    {
        $donator->increment('donation_count');

        $this->transactionForm->target = $fundId;
        $this->transactionForm->amount = str_replace([',', '.'], '', $record['amount']);
        $this->transactionForm->date = Carbon::createFromFormat('d-m-Y', $record['date'])->format('Y-m-d');
        $this->transactionForm->description = $record['description'] ??
            ($record['amount'] > 0 ? 'Don' : __('amorce.misc-withdrawal')) . ' from CSV import';
        $this->transactionForm->hash = $hash;
        $this->transactionForm->create();
    }

    private function checkDonator(array $record): ?Donator
    {
        $this->currentDonator = null;

        $this->checkIfDonatorExist(name: $record['name']);


        $this->handleDonatorNotFound($record);
        return null;
    }


    public function handleDonatorNotFound($data)
    {
        $this->name = $data['name'];
        $this->address = $data['adresse'] ?? '';
        $this->showDonatorForm = true;
    }

    public function handleFundNotFound($data)
    {
        $this->existingFunds = Fund::all();
        $this->showFundForm = true;
    }

    public function handleMultipleDonatorsFound($data)
    {
        $this->multipleDonators = $data['candidates'];
        $this->showMultipleDonatorsModal = true;
    }

    public function selectDonator($donatorId)
    {
        $this->currentDonator = Donator::find($donatorId);
        if ($this->currentRecord) {
            $hash = md5(json_encode($this->currentRecord));
            $fundId = $this->generalFundId;
            $this->createTransaction($this->currentRecord, $this->currentDonator, $fundId, $hash);
            $this->processedRecords++;
            $this->currentRecord = null;

            $this->resume($this->filePath);
        }
        $this->showMultipleDonatorsModal = false;
        $this->multipleDonators = [];

    }

    public function checkIfDonatorExist($name)
    {
        $normalizedName = $this->normalizeString($name);

        $exactMatch = Donator::whereRaw('LOWER(REPLACE(name, " ", "")) = ?', [
            str_replace(' ', '', $normalizedName)
        ])->first();

        if ($exactMatch) {
            return $exactMatch;
        }

        $approximateMatches = Donator::all()->filter(function ($donator) use ($normalizedName) {
            $donatorName = $this->normalizeString($donator->name);
            return levenshtein($normalizedName, $donatorName) <= 3;
        });

        if ($approximateMatches->count() > 1) {
            $this->multipleDonators = $approximateMatches->map(fn($d) => [
                'id' => $d->id,
                'name' => $d->name,
                'address' => $d->address,
            ]);
            $this->dispatch('multipleDonatorsFound', ['candidates' => $this->multipleDonators]);
            return null;
        }
        return null;
    }

    public function createDonator()
    {
        $existingDonator = $this->checkIfDonatorExist($this->name);
        if ($this->multipleDonators) {
            return;
        }

        if ($existingDonator) {
            $this->currentDonator = $existingDonator;
            $this->showDonatorForm = false;
            $this->resume($this->filePath);
            return;
        }
        Donator::create([
            'name' => $this->name,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'address' => $this->address ?? null,
            'donation_count' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->currentDonator = Donator::latest()->first();
        $this->showDonatorForm = false;
        $this->resume($this->filePath);
    }

    public function createOrAssignFund()
    {
        if ($this->newFundName) {
            $this->validate(['newFundName' => 'required|string|max:255']);

            Fund::create([
                'name' => $this->newFundName,
                'type' => 'principal'
            ]);

            $this->initFundsCache();
        }

        $this->showFundForm = false;
        $this->resume($this->filePath);
    }

    private function resume($filePath)
    {
        if ($filePath && Storage::exists($filePath)) {
            $this->processCsv(Storage::path($filePath));
        }
    }

    protected $listeners = [
        'donatorNotFound' => 'handleDonatorNotFound',
        'fundNotFound' => 'handleFundNotFound',
        'multipleDonatorsFound' => 'handleMultipleDonatorsFound',
    ];

    public function render()
    {
        return view('livewire.csv.import-csv');
    }
}
