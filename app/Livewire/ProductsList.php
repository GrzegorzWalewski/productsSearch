<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('manufacturer', 'like', '%' . $this->search . '%')
                ->paginate(5);

        return view('livewire.products-list', compact('products'));
    }
}
