<?php

namespace App\PackageTypes;

use App\Models\PackageType;
use App\Models\Variant;

class Pallet extends PackageType
{
    public static function getLimit(string $unit, ?Variant $variant = null): float
    {
        switch ($unit) {
            case static::UNIT_PIECE:
                return 400;
            case static::UNIT_ROLL:
                return 80;
            case static::UNIT_PALLET:
                return 1;
            case static::UNIT_BOX:
                return 7;
            case static::UNIT_PACKAGE:
                return 2;
            case static::UNIT_M:
                return 200;
            case static::UNIT_M2:
                return 150;
            case static::UNIT_M3:
                return 50;
            default:
                throw new \Exception('Invalid unit');
        }
    }
}