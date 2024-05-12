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
        $name .= $this->weight ? __('Weight') . ': ' . $this->weight . ' kg | ' : '';
        $name .= $this->diameter ? 'ø ' . $this->diameter . ' mm | ' : '';
        $name .= $this->length ? __('Length') . ': ' . $this->length . ' mm | ' : '';
        $name .= $this->width ? __('Width') . ': ' . $this->width . ' mm | ' : '';
        $name .= $this->height ? __('Height') . ': ' . $this->height . ' mm | ' : '';
        $name .= $this->thickness ? __('Thickness') . ': ' . $this->thickness . ' mm | ' : '';

        if ($name === '') {
            return __('Main');
        }

        return substr($name, 0, -2);
    }
}
