<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;

class Box extends AbstractPackageType
{
    public const MAX_ON_PALLET = 7;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        return 1;
    }
}