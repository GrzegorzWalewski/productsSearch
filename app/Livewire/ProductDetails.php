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
        $variant = Variant::find($this->selectedVariant);
        $packageClass = PackageType::getPackageClass($packageType);
        
        try {
            $this->purchasePackageQuantity = $packageClass->calculatePurchasePackageQuantity($this->quantity, $variant, $this->product->purchasePackageType->name, $this->product->price_unit, $this->product->purchase_unit_quantity ?? 1);
            if ($this->product->packageType->name === $this->product->purchasePackageType->name) {
                $this->packageQuantity = $this->purchasePackageQuantity;
            } else {
                $this->packageQuantity = $packageClass->calculatePackageQuantity($this->purchasePackageQuantity, $this->product->purchasePackageType->name, $this->product->purchase_unit_quantity ?? 1);
            }

            $this->finalPriceUnitQuantity = $packageClass->calculateFinalPriceUnitQuantity($this->packageQuantity, $variant, $this->product->price_unit);
        } catch (\Error $error) {
            $this->resetQuantity();
            $this->error = $error->getMessage();
        }
    }
}
