<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $fillable = [
        'status',
        'date',
        'total_amount'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
