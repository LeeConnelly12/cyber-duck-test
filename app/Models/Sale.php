<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function formattedUnitCost()
    {
        return '£' . number_format($this->unit_cost / 100, 2);
    }

    public function formattedSellingPrice()
    {
        return '£' . number_format($this->selling_price / 100, 2);
    }
}
