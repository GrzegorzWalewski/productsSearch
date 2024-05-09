<?php

namespace App\Models;

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
}
