<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;

class Pallet extends AbstractPackageType
{
    public const TYPE = 'pallet';

    public const M_MAX_ON_PALLET = 200;

    public const M2_MAX_ON_PALLET = 150;
    public const MAX_ON_PALLET = 1;

    private $priceUnit;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        $this->priceUnit = $priceUnit;

        if ($priceUnit === 'M2') {
            return ($variant->length / 1000) * ($variant->width / 1000);
        }
        
        return $variant->width / 1000;
    }

    public function calculatePurchasePackageQuantity(float $quantity, Variant $variant, ?string $purchasePackageType, string $priceUnit, int $purchaseUnitQuantity): int
    {
        $this->priceUnit = $priceUnit;

        return ceil($quantity / $this->getMaxQuantityOnPurchasePackage($purchasePackageType, $purchaseUnitQuantity));
    }

    public function calculateFinalPriceUnitQuantity(int $packageQuantity, Variant $variant, string $priceUnit): float
    {
        return $this->getMaxQuantityOnPallet() * $packageQuantity;
    }

    protected function getMaxQuantityOnPurchasePackage(?string $purchasePackageType, int $purchaseUnitQuantity): int
    {
        $maxOnPallet = $this->getMaxQuantityOnPallet();

        switch ($purchasePackageType) {
            case Pallet::TYPE:
                return $maxOnPallet * $purchaseUnitQuantity;
            case Package::TYPE:
                return $maxOnPallet * $purchaseUnitQuantity * 2;
            default:
                return $purchaseUnitQuantity;
        }
    }

    private function getMaxQuantityOnPallet(): int
    {
        switch($this->priceUnit) {
            case 'M2':
                return self::M2_MAX_ON_PALLET;
            case 'M':
                return self::M_MAX_ON_PALLET;
        }

        return self::MAX_ON_PALLET;
    }
}