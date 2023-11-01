<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $table = 'address';

    protected $fillable = [
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
