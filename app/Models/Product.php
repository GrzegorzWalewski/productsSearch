<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PackageType;
use App\Models\Variant;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manufacturer', 'price_unit', 'purchase_unit_quantity', 'package_type_id', 'purchase_package_type_id'];

    public function packageType()
    {
        return $this->belongsTo(PackageType::class, 'package_type_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
    }
}
