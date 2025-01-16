<?php

namespace App\Livewire\Csv;

use App\Livewire\Forms\DonatorForm;
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
        'csvFile' => null, // Initialize the file input property
    ];
    public $showDonatorForm = false;
    public $showFundForm = false;
    public $name, $iban, $address; // Donator data
    public $type, $newFundName; // Fund data
    public $existingFunds = [];
    public $filePath ='';

    public function import()
    {
        $this->validate([
            'form.csvFile' => 'required|mimes:csv,txt|max:2048', // Limit file size and type
        ]);

        // Retrieve the uploaded file
        $uploadedFile = $this->form['csvFile'];

        // Save uploaded file temporarily
        $this->filePath = $uploadedFile->store('temp');

        // Process the file
        $this->processCsv(Storage::path($this->filePath));

        // Clean up temporary file
        Storage::delete($this->filePath);
        $this->filePath = '';
    }

    private function processCsv(string $filePath)
    {
        $csv = Reader::createFromPath($filePath)->select(0, 2, 3, 5, 6, 8);

        $records = $csv->getRecords(['date', 'amount', 'IBAN', 'name', 'adresse', 'description']);

        foreach ($records as $key => $record) {
            // Générer un hash pour cette ligne
            //$hash = md5(json_encode($record));

            // Vérifier si la transaction existe déjà via le hash
//            if (Transaction::where('hash', $hash)->exists()) {
//                continue; // Ignorer si déjà existant
//            }

            $fund = Fund::where('type', 'principal')->first();

            if (!$fund) {
                $this->dispatch('fundNotFound');
                return;
            }
            // Vérifier si le donateur existe (basé sur nom et IBAN)

            $donator = Donator::where('name', $record['name'])
                ->first();

            if (!$donator) {
                // Dispatch modal pour créer un donateur
                $this->dispatch('donatorNotFound', [
                    'name' => $record['name'],
                    'address' => $record['adresse'],
                ]);
                return;
            }

            // Si le donateur existe, incrémenter le compteur de dons
            $donator->increment('donation_count');

            // Ajouter la transaction
            Transaction::create([
                'fund_id' => $fund->id,
                'amount' => str_replace(',', '', $record['amount']),
                'date' => Carbon::createFromFormat('d-m-Y', $record['date'])->format('Y-m-d'),
                'title' => $record['amount'] > 0 ? 'Don' : 'Retrait',
                'description' => $record['description'] ?? __('Transaction from CSV import'),
                //'hash' => $hash,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
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
            //'donation_count' => 4,
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
