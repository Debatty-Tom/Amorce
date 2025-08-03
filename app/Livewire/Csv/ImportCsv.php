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
use League\Csv\Reader;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCsv extends Component
{
    use WithFileUploads;

    public $form = [
        'csvFile' => null,
    ];
    public TransactionForm $transactionForm;
    public $showDonatorForm = false;
    public $showFundForm = false;
    public $name, $iban, $address;
    public $type, $newFundName;
    public $existingFunds = [];
    public $filePath ='';

    public function import()
    {
        $this->validate([
            'form.csvFile' => 'required|mimes:csv,txt|max:2048', // Limit file size and type
        ]);

        $uploadedFile = $this->form['csvFile'];

        $this->filePath = $uploadedFile->store('temp');

        $this->processCsv(Storage::path($this->filePath));

        Storage::delete($this->filePath);
        $this->filePath = '';
    }

    private function processCsv(string $filePath)
    {
        $csv = Reader::createFromPath($filePath)->select(0, 2, 3, 5, 6, 8);

        $records = $csv->getRecords(['date', 'amount', 'IBAN', 'name', 'adresse', 'description']);

        foreach ($records as $key => $record) {
            $hash = md5(json_encode($record));

            if (Transaction::where('hash', $hash)->exists()) {
                continue;
            }

            $fund = Fund::where('type', 'principal')->first();

            if (!$fund) {
                $this->dispatch('fundNotFound');
                return;
            }

            $donator = Donator::where('name', $record['name'])
                ->first();

            if (!$donator) {
                $this->dispatch('donatorNotFound', [
                    'name' => $record['name'],
                    'address' => $record['adresse'],
                ]);
                return;
            }

            $donator->increment('donation_count');
            $this->transactionForm->target = $fund->id;
            $this->transactionForm->amount = str_replace(',', '', $record['amount']);
            $this->transactionForm->date = Carbon::createFromFormat('d-m-Y', $record['date'])->format('Y-m-d');
            $this->transactionForm->description = $record['description'] ?? __($record['amount'] > 0 ? 'Don' : 'Retrait' . 'from CSV import');
            $this->transactionForm->hash = $hash;
            $this->transactionForm->create();
        }
    }

    public function handleDonatorNotFound($data)
    {
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->showDonatorForm = true;

    }

    public function handleFundNotFound()
    {
        $this->existingFunds = Fund::all(); // Charger les fonds existants
        $this->showFundForm = true;
    }
    protected $listeners = [
        'donatorNotFound' => 'handleDonatorNotFound',
        'fundNotFound' => 'handleFundNotFound',
    ];
    public function createDonator()
    {
        Donator::create([
            'name' => $this->name,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'address' => $this->address ?? null,
            'donation_count' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->showDonatorForm = false;
    }
    public function createOrAssignFund()
    {
        // Validation et création/association...
        $this->showFundForm = false;
    }


    public function render()
    {
        return view('livewire.csv.import-csv');
    }
}
