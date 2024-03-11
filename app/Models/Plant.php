<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use DateTimeInterface;

class Plant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = "plant";
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
        'placement',
        'temperature',
        'water_need',
        'sunlight_need',
        'height',
        'size',
        'weight',
        'origin',
        'other',
        'pot_name',
        'pot_size',
        'experience',
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
     * Get the plant's image url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->img_decode($this->image);
        // return asset('/plant_image/' . $this->image);
    }

    /**
     * Get the category that owns the plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
