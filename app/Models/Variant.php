<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'weight', 'diameter', 'length', 'width', 'height', 'thickness'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getName(): string
    {
        $name = '';
        $name .= $this->weight ? 'Weight: ' . $this->weight . ' kg | ' : '';
        $name .= $this->diameter ? 'ø ' . $this->diameter . ' mm | ' : '';
        $name .= $this->length ? 'Length: ' . $this->length . ' mm | ' : '';
        $name .= $this->width ? 'Width: ' . $this->width . ' mm | ' : '';
        $name .= $this->height ? 'Height: ' . $this->height . ' mm | ' : '';
        $name .= $this->thickness ? 'Thickness: ' . $this->thickness . ' mm | ' : '';

        if ($name === '') {
            return 'Main';
        }

        return substr($name, 0, -2);
    }
}
