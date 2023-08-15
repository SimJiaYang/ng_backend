<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
