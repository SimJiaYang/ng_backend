<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    public $table = 'order';
    public $primaryKey = 'id';
    public $foreignKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'merhandise_fee',
        'shipping_fee',
        'total_amount',
        'address',
        'is_separate',
        'note',
        'name',
        'contact_number',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Order status
     *
     * @var array<int, string>
     */
    public const STATUS = [
        '0' => "cancel",
        '1' => "To Pay",
        '2' => "Completed",
        '3' => "To Ship",
        '4' => "Cancel"
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order detail for the order.
     */
    public function order_detail()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id');
    }

    /**
     * Get the delivery for the order.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'order_id');
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
