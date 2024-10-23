<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * The classes that I think we do not need their functions
 * but somehow, in some examples that I found
 * they are oftenly used. Will leave it as the imported-unused-clas for now.
 */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'gender',
        'age',
        'image',
        'address',
        'role',
        'is_verified',
        'email_verified_at',
    ];

    /**
     * Set the is_verified attribute to false for new item.
     * So we do not need to define it in the controller.
     * @var array
     */
    protected $attributes = [
        'image' => null,
        'role' => 'employee',
        'is_verified' => false,
        'email_verified_at' => null,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender' => 'string',
            'age' => 'integer',
            'image' => 'string',
            'role' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Summary of setPasswordAttribute
     * @param mixed $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the identifier that will be stored in the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key-value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Execute some actions when certain Eloquent events are triggered
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->is_verified) {
                $user->verifications()->delete();
            }
        });
    }

    public function verifications()
    {
        return $this->hasMany(UserVerification::class, 'email', 'email');
    }
}
