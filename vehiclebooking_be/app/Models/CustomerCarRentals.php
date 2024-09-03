<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CustomerCarRentals extends Model
{
    use HasFactory;
    // khai báo biến
    protected $connection = 'mongodb';
    protected $collection = 'cus_carrentals';

    protected $fillable = ['cus_id','car_select','car_price','pickup_location','destination','start_date','end_date'];
}
