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
        'image_url',
        'image_file_name'
    ];

    /**
     * Get the plant's image url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->img_decode($this->image);
    }

    /**
     * Get the plant's image file name.
     *
     * @return string
     */
    public function getImageFileNameAttribute()
    {
        $data =  $this->image;
        if ($data) {
            $data = explode("|", $data);
        }
        return $data;
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

    /**
     * @param string $data
     * @return array|string
     */
    function img_decode($data)
    {
        if ($data) {
            $data = explode("|", $data);

            if (count($data) > 1) {
                foreach ($data as &$d) {
                    $d = $this->image_parse($d);
                }
            } else {
                $data = implode("|", $data);
            }
        }
        return $data;
    }

    /**
     * @param string $url
     * @return string
     */
    function image_parse($url)
    {
        $parse = parse_url($url);
        if ($url) {
            if (isset($parse["host"])) {
                return $url;
            } else {
                return config("app.url") . "/plant_image/" . $url;
            }
        }
        return $url;
    }
}
