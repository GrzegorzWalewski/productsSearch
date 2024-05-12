<?php

namespace App\PackageTypes;

use App\Models\PackageType;
use App\Models\Variant;

class Package extends PackageType
{
    public static function getLimit(string $unit, ?Variant $variant = null): float
    {
        switch ($unit) {
            case static::UNIT_PIECE:
                return 200;
            case static::UNIT_ROLL:
                return 40;
            case static::UNIT_PALLET:
                return 0.5;
            case static::UNIT_BOX:
                return 3.5;
            case static::UNIT_PACKAGE:
                return 1;
            case static::UNIT_M:
                return 100;
            case static::UNIT_M2:
                return 75;
            case static::UNIT_M3:
                return 25;
            default:
                throw new \Exception('Invalid unit');
        }
    }
}