<?php

namespace App\Livewire;

use App\Models\Variant;
use Livewire\Component;
use App\Models\PackageType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductDetails extends Component
{
    public $product;

    public $selectedVariant = null;

    public $quantity = null;

    public $packageQuantity = null;

    public $purchasePackageQuantity = null;

    public $finalPriceUnitQuantity = null;

    public $error = null;

    public function mount($product): void
    {
        $this->product = $product;
    }

    public function render(): Factory|View
    {
        if ($this->quantity) {
            $this->calculateFinal();
        } else {
            $this->resetQuantity();
        }

        if (!$this->selectedVariant && $this->product->variants->count() === 1) {
            $this->selectedVariant = $this->product->variants->first()->id;
        }

        return view('livewire.product-details', [
            'product' => $this->product,
            'error' => $this->error
        ]);
    }

    public function resetQuantity(): void
    {
        $this->quantity = null;
        $this->purchasePackageQuantity = null;
        $this->packageQuantity = null;
        $this->finalPriceUnitQuantity = null;
    }

    public function calculateFinal(): void
    {
        $packageType = $this->product->packageType->name;
        $purchasePackageType = $this->product->purchasePackageType->name;
        $priceUnit = $this->product->price_unit;
        $variant = Variant::find($this->selectedVariant);
        $purchaseUnitQuantity = $this->product->purchase_unit_quantity ?? 1;

        if ($packageType != null)
        {
            $packageLimit = PackageType::getPackageLimit($packageType, $purchasePackageType) * $purchaseUnitQuantity;
            $pieceLimit = PackageType::getPackageLimit($priceUnit, $packageType, $variant);
            $limit = $packageLimit * $pieceLimit;
        } else {
            $limit = PackageType::getPackageLimit($priceUnit, $purchasePackageType, $variant) * $purchaseUnitQuantity;
        }
        
        $this->purchasePackageQuantity = ceil($this->quantity / $limit);
        $this->finalPriceUnitQuantity = $this->purchasePackageQuantity * $limit;

        if ($packageLimit)
        {
            $this->packageQuantity = $this->purchasePackageQuantity * $packageLimit;
        } else {
            $this->packageQuantity = null;
        }
    }
}
