<?php

namespace App\PackageTypes;

use App\PackageTypes\AbstractPackageType;
use App\Models\Variant;

class Package extends AbstractPackageType
{
    public const TYPE = 'package';
    public const MAX_ON_PALLET = 2;

    public function calcSize(Variant $variant, string $priceUnit): float
    {
        return ($variant->length / 1000) * ($variant->width / 1000);
    }
}