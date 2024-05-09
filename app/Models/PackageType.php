<?php

namespace App\Models;

use App\PackageTypes\AbstractPackageType;
use App\PackageTypes\Box;
use App\PackageTypes\Package;
use App\PackageTypes\Pallet;
use App\PackageTypes\Piece;
use App\PackageTypes\Roll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function toEng(?string $name): string
    {
        switch ($name) {
            case 'rolka':
                return 'roll';
            case 'paczka':
                return 'package';
            case 'karton':
                return 'box';
            case 'pełna paleta':
            case 'paleta':
                return 'pallet';
            default:
                return 'piece';
        }
    }

    public static function getPackageClass(string $name): AbstractPackageType
    {
        switch ($name) {
            case 'roll':
                return new Roll();
            case 'package':
                return new Package();
            case 'box':
                return new Box();
            case 'pallet':
                return new Pallet();
            default:
                return new Piece();
        }
    }
}
