<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = 'stock';
    public $primaryKey = 'id';
    public $foreignKey1 = 'product_id';
    public $foreignKey2 = 'plant_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reason',
        'quantity',
        'unit_price',
        'product_id',
        'plant_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the product that owns the stock.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the plant that owns the stock.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }
}
