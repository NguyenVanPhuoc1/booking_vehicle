<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class OauthClient extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'oauth_clients'; // Tên collection trong MongoDB

    protected $fillable = [
        'user_id',
        'name',
        'secret',
        'provider',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked',
        'updated_at',
        'created_at',
    ];

    // Nếu bạn muốn sử dụng timestamps, hãy đảm bảo rằng các trường này được cấu hình đúng
    public $timestamps = true; // Nếu không cần, có thể bỏ qua
}
