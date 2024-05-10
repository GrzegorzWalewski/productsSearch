<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;
use App\PackageTypes\Pallet;
use App\PackageTypes\Package;

class Piece extends AbstractPackageType
{
    public const M_MAX_ON_PALLET = 200;
    public const M2_MAX_ON_PALLET = 150;
    public const MAX_ON_PALLET = 400;

    // max value for m3 is not established so we use pieces max instead
    public const M3_MAX_ON_PALLET = self::MAX_ON_PALLET;
    private string $priceUnit;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        $this->priceUnit = $priceUnit;

        if ($priceUnit === 'M2') {
            return ($variant->length / 1000) * ($variant->width / 1000);
        } elseif ($priceUnit === 'M3') {
            return ($variant->length / 1000) * ($variant->width / 1000) * ($variant->thickness / 1000);
        } elseif ($priceUnit === 'M') {
            return $variant->length / 1000;
        }

        return 1;
    }

    protected function getMaxQuantityOnPurchasePackage(?string $purchasePackageType, ?int $purchaseUnitQuantity): int
    {
        switch($this->priceUnit) {
            case 'M2':
                $maxOnPallet = self::M2_MAX_ON_PALLET;
                break;
            case 'M3':
                $maxOnPallet = self::M3_MAX_ON_PALLET;
                break;
            case 'M':
                $maxOnPallet = self::M_MAX_ON_PALLET;
                break;
            default:
                $maxOnPallet = self::MAX_ON_PALLET;
        }

        switch ($purchasePackageType) {
            case Pallet::TYPE:
                return $maxOnPallet * $purchaseUnitQuantity;
            case Package::TYPE:
                return $maxOnPallet * $purchaseUnitQuantity * 2;
            default:
                return $purchaseUnitQuantity ?? 1;
        }
    }
}