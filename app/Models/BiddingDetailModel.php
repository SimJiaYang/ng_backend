<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiddingDetailModel extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk = 'user_id';

    public $fk1 = 'bidding_id';

    protected $fillable = [
        'amount',
        'refund_status',
        'payment_way',
        'user_id',
        'bidding_id',
        'created_at',
        'updated_at',
    ];
}
