<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function formattedUnitCost()
    {
        return '£' . $this->unit_cost / 100;
    }

    public function formattedSellingPrice()
    {
        return '£' . $this->selling_price / 100;
    }
}
