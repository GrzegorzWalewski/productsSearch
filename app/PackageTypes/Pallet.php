<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;

class Pallet extends AbstractPackageType
{
    public const TYPE = 'pallet';
    public const MAX_ON_PALLET = 1;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        if ($priceUnit === 'M2') {
            return ($variant->length / 1000) * ($variant->width / 1000);
        }
        
        return $variant->width / 1000;
    }
}