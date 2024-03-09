<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DateTimeInterface;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = "product";
    public $primaryKey = 'id';
    public $foreignKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'image',
        'sales_amount',
        'material',
        'length',
        'size',
        'weight',
        'other',
        'status',
        'category_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Append image_url to the model
     *
     * @var array<int, string>
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
        return  json_encode(asset('/product_image/' . $this->image));
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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
