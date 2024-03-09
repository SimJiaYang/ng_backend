<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'birth_date',
        'gender',
        'contact_number',
        'image',
        'type',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Append image_url when get user data
     *
     * @var string
     */
    public $appends = [
        'image_url'
    ];

    /**
     * Get the user's image url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('/user_image/' . $this->image);
        } else {
            return null;
        }
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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
