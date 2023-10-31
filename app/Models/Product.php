<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";

    public $primaryKey = 'id';

    public $fk = 'cat_id';

    protected $fillable = [
        'name',
        'sales_amount',
        'price',
        'description',
        'quantity',
        'status',
        'image',
        'cat_id'
    ];

    public $appends = [
        'image_url'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];

    public function getImageUrlAttribute()
    {
        return  json_encode(asset('/product_image/' . $this->image));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
