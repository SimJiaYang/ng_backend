<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk1 = 'product_id';

    public $fk2 = 'plant_id';

    public $fk3 = 'bidding__id';

    public $fk4 = 'user_id';

    protected $fillable = [
        'quantity',
        'price',
        'date_added',
        'is_purchase',
        'product_id',
        'plant_id',
        'bidding_id',
        'user_id'
    ];
}
