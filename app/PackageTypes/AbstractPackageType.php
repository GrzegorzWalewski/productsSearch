<?php

namespace App\PackageTypes;

use App\Models\Variant;
use App\PackageTypes\Pallet;
use App\PackageTypes\Package;

abstract class AbstractPackageType
{
    public abstract function calcSize(Variant $variant, string $priceUnit): float;
    
    public function calculatePurchasePackageQuantity(float $quantity, Variant $variant, ?string $purchasePackageType, string $priceUnit, int $purchaseUnitQuantity): int
    {
        $unitSize = $this->calcSize($variant, $priceUnit);
        $unitQuantity = ceil($quantity / $unitSize);
        return ceil($unitQuantity / $this->getMaxQuantityOnPurchasePackage($purchasePackageType, $purchaseUnitQuantity));
    }

    public function calculateFinalPriceUnitQuantity(int $packageQuantity, Variant $variant, string $priceUnit): float
    {
        return $this->calcSize($variant, $priceUnit) * $packageQuantity;
    }

    public function calculatePackageQuantity(int $purchasePackageQuantity, ?string $purchasePackageType, int $purchaseUnitQuantity): int
    {
        return $purchasePackageQuantity * $this->getMaxQuantityOnPurchasePackage($purchasePackageType, $purchaseUnitQuantity);
    }

    protected function getMaxQuantityOnPurchasePackage(?string $purchasePackageType, int $purchaseUnitQuantity): int
    {
        switch ($purchasePackageType) {
            case Pallet::TYPE:
                return static::MAX_ON_PALLET * $purchaseUnitQuantity;
            case Package::TYPE:
                return static::MAX_ON_PALLET * $purchaseUnitQuantity * 2;
            default:
                return $purchaseUnitQuantity;
        }
    }
}