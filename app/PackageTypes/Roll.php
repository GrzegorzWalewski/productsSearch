<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;

class Roll extends AbstractPackageType
{
    public const MAX_ON_PALLET = 80;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        return ($variant->length / 1000) * ($variant->width / 1000);
    }
}