<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Plant extends Model
{
    use HasFactory;

    protected $table = "plant";

    public $primaryKey = 'id';

    public $fk = 'cat_id';

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'sunglight_need',
        'water_need',
        'mature_height',
        'origin',
        'status',
        'image',
        'cat_id'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];

    public static function getImageUrlAttribute($value)
    {
        return env('APP_URL') . '/' . $value;
    }
}
