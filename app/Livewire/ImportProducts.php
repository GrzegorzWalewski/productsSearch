<?php

namespace App\Livewire;

use App\Imports\ProductsImport;
use App\Imports\VariantsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Maatwebsite\Excel\Facades\Excel;

class ImportProducts extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimes:xls')]
    public $file;

    public function save()
    {
        $this->validate();

        Excel::import(new ProductsImport, $this->file);
        Excel::import(new VariantsImport, $this->file);

        $this->reset();

        session()->flash('status', 'File imported successfully!');

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.import-products');
    }
}
