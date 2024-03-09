<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Delivery extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = 'delivery';
    public $primaryKey = 'id';
    public $foreignKey1 = 'order_id';
    public $foreignKey2 = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tracking_number',
        'courier',
        'method',
        'status',
        'delivered_img',
        'expected_date',
        'order_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Append the delivered image url to the model
     */
    public $appends = [
        'image_url'
    ];

    /**
     * Get the image url attribute.
     *
     * @var array<int, string>
     */
    public function getImageUrlAttribute()
    {
        return json_encode(asset('/delivery_prove/' . $this->prv_img));
    }

    /**
     * Get the order that owns the delivery.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the user that owns the delivery.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
