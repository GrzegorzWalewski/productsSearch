<?php

namespace App\Livewire;

use Livewire\Component;

class ProductDetails extends Component
{
    public $product;

    public $selectedVariant = null;

    public $quantity = null;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        if ($this->selectedVariant) {
            // zakladamy, ze mamy m2 i rolki, trzeba policzyc ile palet(jednostek zakupowych) to wychodzi z ilosci sztuk 80 rolek to limit
            // quantity / rolki (x * y) wychodzi nam ile rolek chce klient
            // ceil(rolki / 80) to ilosc palet
            
            
            

        }

        return view('livewire.product-details', [
            'product' => $this->product
        ]);
    }
}
