<?php

namespace App\Models;

use App\PackageTypes\Box;
use App\PackageTypes\Package;
use App\PackageTypes\Pallet;
use App\PackageTypes\Roll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    use HasFactory;

    public const UNIT_PIECE = 'piece';
    public const UNIT_M = 'M';
    public const UNIT_M2 = 'M2';
    public const UNIT_M3 = 'M3';
    public const UNIT_PACKAGE = 'package';
    public const UNIT_ROLL = 'roll';
    public const UNIT_PALLET = 'pallet';
    public const UNIT_BOX = 'box';
    public const UNIT_NONE = 'none';

    protected $fillable = ['name'];

    public static function toEng(?string $name): string
    {
        switch ($name) {
            case 'rolka':
                return self::UNIT_ROLL;
            case 'paczka':
                return self::UNIT_PACKAGE;
            case 'karton':
                return self::UNIT_BOX;
            case 'pełna paleta':
            case 'paleta':
                return self::UNIT_PALLET;
            case null:
                return self::UNIT_NONE;
            default:
                return self::UNIT_PIECE;
        }
    }

    public static function getPackageLimit(string $priceUnit, string $packageType, ?Variant $variant = null): float
    {
        switch ($packageType) {
            case self::UNIT_PALLET:
                return Pallet::getLimit($priceUnit);
            case self::UNIT_PACKAGE:
                return Package::getLimit($priceUnit, $variant);
            case self::UNIT_BOX:
                return Box::getLimit($priceUnit, $variant);
            case self::UNIT_ROLL:
                return Roll::getLimit($priceUnit, $variant);
            default:
                return 1;
        }
    }

    public static function getLimit(string $unit, ?Variant $variant = null): float
    {
        switch ($unit) {
            case static::UNIT_PIECE:
            case static::UNIT_ROLL:
            case static::UNIT_BOX:
            case static::UNIT_PALLET:
            case static::UNIT_PACKAGE:
                return 1;
            case static::UNIT_M:
                return self::calcUnitM($variant);
            case static::UNIT_M2:
                return self::calcUnitM2($variant);
            case static::UNIT_M3:
                return self::calcUnitM3($variant);
            default:
                throw new \Exception('Invalid unit');
        }
    }

    public static function calcUnitM(Variant $variant): float
    {
        return max([
            $variant->length,
            $variant->width,
            $variant->height
        ]) / 1000;
    }

    public static function calcUnitM2(Variant $variant): float
    {
        return $variant->length * $variant->width / 1000000;
    }

    public static function calcUnitM3(Variant $variant): float
    {
        $thirdVariable = max([
            $variant->height,
            $variant->thickness,
        ]);

        return $variant->length * $variant->width * $thirdVariable / 1000000000;
    }
}
