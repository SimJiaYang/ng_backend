<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = 'payment';

    public $primaryKey = 'id';

    public $fk1 = 'order_id';

    public $fk2 = 'bidding_id';

    protected $fillable = [
        'status',
        'amount',
        'details',
        'method',
        'date',
        'order_id',
        'user_id',
        'bidding_id'
    ];
}
