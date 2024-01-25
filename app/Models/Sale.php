<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function formattedSellingPrice()
    {
        return '£' . $this->selling_price / 100;
    }
}
