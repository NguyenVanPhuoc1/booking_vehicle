<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'personal_access_tokens';
    protected $fillable = ['tokenable_id', 'tokenable_type', 'name', 'token', 'abilities', 'expires_at'];
}
