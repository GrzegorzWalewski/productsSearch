<?php

namespace App\Imports;

use App\Models\Variant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Product;

class VariantsImport implements ToModel, WithHeadingRow
{
    public const WEIGHT_HEADING = 'waga';
    public const DIAMETER_HEADING = 'srednica';
    public const LENGTH_HEADING = 'dlugosc';
    public const WIDTH_HEADING = 'szerokosc';
    public const HEIGHT_HEADING = 'wysokosc';
    public const THICKNESS_HEADING = 'grubosc';

    public const NAME_HEADING = 'nazwa_produktu';

    public const MANUFACTURER_HEADING = 'producent';

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::where('name', $row[self::NAME_HEADING])->where('manufacturer', $row[self::MANUFACTURER_HEADING])->first();

        if (!$product) {
            throw new \Exception('Product %s %s not found', $row[self::MANUFACTURER_HEADING], $row[self::NAME_HEADING]);
        }

        return Variant::firstOrNew([
            'product_id' => $product->id,
            'weight' => $row[self::WEIGHT_HEADING],
            'diameter' => $row[self::DIAMETER_HEADING],
            'length' => $row[self::LENGTH_HEADING],
            'width' => $row[self::WIDTH_HEADING],
            'height' => $row[self::HEIGHT_HEADING],
            'thickness' => $row[self::THICKNESS_HEADING],
        ]);
    }
}
