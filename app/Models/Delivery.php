<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk = 'order_id';

    protected $fillable = [
        'tracking_number',
        'method',
        'status',
        'details',
        'expected_date',
        'order_id'
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
