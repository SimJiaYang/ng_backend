<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DateTimeInterface;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Include the table name, primary key, and foreign key in the model
     * @var string
     */
    protected $table = "category";
    public $primaryKey = 'id';
    public $foreignKey = 'parent_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'type',
        'status',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the products for the category.
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the plants for the category.
     */
    public function plant(): HasMany
    {
        return $this->hasMany(Plant::class);
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
}
