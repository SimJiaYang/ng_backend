<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $fk = 'winner_id';

    public $fk1 = 'plant_id';

    protected $fillable = [
        'min_amount',
        'status',
        'winner_id',
        'highest_amount',
        'final_amount',
        'start_time',
        'end_time',
        'plant_id',
    ];

    public const STATUS = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
}
