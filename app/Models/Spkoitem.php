<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spkoitem extends Model
{
    use HasFactory;
    protected $table = 'spko_items';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
