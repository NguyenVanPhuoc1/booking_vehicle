<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CustomerQuestion extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'cus_questions';

    // fillable được khai báo mới dùng được ::create và::updateOrCreate
    protected $fillable = ['cus_id','cus_question','noi_bat'];

}
