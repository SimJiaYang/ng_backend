<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk = 'cat_id';

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'status',
        'image',
        'cat_id'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
