<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk = 'winner';

    public $fk1 = 'plant_id';

    protected $fillable = [
        'history',
        'min_amount',
        'status',
        'message',
        'winner',
        'win_amount',
        'start_time',
        'end_time',
        'plant_id',
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
