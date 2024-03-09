<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class OrderDetailModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = "order_detail";
    public $primaryKey = 'id';
    public $foreignKey1 = 'order_id';
    public $foreignKey2 = 'product_id';
    public $foreignKey3 = 'plant_id';
    public $foreignKey4 = 'delivery_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'unit_price',
        'total_amount',
        'remark',
        'order_id',
        'product_id',
        'plant_id',
        'delivery_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the order that owns the order detail.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the product that owns the order detail.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the plant that owns the order detail.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }

    /**
     * Get the delivery that owns the order detail.
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
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
