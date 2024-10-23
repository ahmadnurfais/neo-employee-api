<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserVerification extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $fillable = ['user_id', 'email', 'otp', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
