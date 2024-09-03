<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace use Illuminate\Database\Eloquent\Model; = use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class CarImages extends Model
{
    use HasFactory;
    // khai báo biến
    protected $connection = 'mongodb';
    protected $collection = 'car_images';

    protected $fillable = [];
}
