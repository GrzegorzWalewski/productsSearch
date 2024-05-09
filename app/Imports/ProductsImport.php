<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use App\Models\PackageType;

class ProductsImport implements ToModel, WithHeadingRow, WithUpserts
{
    public const NAME_HEADER = 'nazwa_produktu';
    public const MANUFACTURER_HEADER = 'producent';
    public const PRICE_UNIT_HEADER = 'jednostka_ceny';
    public const PURCHASE_UNIT_QUANTITY_HEADER = 'jednostki_zakupu';
    public const PACKAGE_TYPE_HEADER = 'typ_pakowania';
    public const PURCHASE_PACKAGE_TYPE_HEADER = 14;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $packageTypeName = PackageType::toEng($row[self::PACKAGE_TYPE_HEADER]);
        $packageTypeId = PackageType::where('name', $packageTypeName)->first()->id;

        $purchasePackageTypeName = PackageType::toEng($row[self::PURCHASE_PACKAGE_TYPE_HEADER]);
        $purchasePackageTypeId = PackageType::where('name', $purchasePackageTypeName)->first()->id;

        try {
            return new Product([
                'name' => $row[self::NAME_HEADER],
                'manufacturer' => $row[self::MANUFACTURER_HEADER],
                'price_unit' => $row[self::PRICE_UNIT_HEADER],
                'purchase_unit_quantity' => $row[self::PURCHASE_UNIT_QUANTITY_HEADER],
                'package_type_id' => $packageTypeId,
                'purchase_package_type_id' => $purchasePackageTypeId,
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to import row: '.json_encode($row));
        }
    }

    public function uniqueBy()
    {
        return ['name', 'manufacturer'];
    }
}
