<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $table = 'order';

    protected $fillable = [
        'status',
        'date',
        'total_amount',
        'address_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public const STATUS = [
        '0' => "cancel",
        '1' => "To Pay",
        '2' => "Completed",
        '3' => "To Ship",
        '4' => "Cancel"
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id');
    }
}
