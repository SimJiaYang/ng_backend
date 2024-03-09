<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DateTimeInterface;

class Cart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = 'cart';
    public $primaryKey = 'id';
    public $foreignKey1 = 'product_id';
    public $foreignKey2 = 'plant_id';
    public $foreignKey3 = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'unit_price',
        'is_purchase',
        'product_id',
        'plant_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the product that owns the cart.
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    /**
     * Get the plant that owns the cart.
     */
    public function plant(): HasMany
    {
        return $this->hasMany(Plant::class, 'plant_id');
    }

    /**
     * Get the user that owns the cart.
     */
    public function user(): BelongsTo
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
