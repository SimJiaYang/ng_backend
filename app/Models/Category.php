<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function plant(): HasMany
    {
        return $this->hasMany(Plant::class);
    }
}
