<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\Cars;

class CarsSpecifications extends Model
{
    use HasFactory;
    // khai báo biến
    protected $connection = 'mongodb';
    protected $collection = 'car_specifications';

    protected $guarded = [];

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id', '_id');
    }
}
