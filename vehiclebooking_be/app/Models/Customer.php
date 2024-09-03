<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\CustomerCarRentals;

class Customer extends Model{

    use HasFactory;
    // khai báo biến
    protected $connection = 'mongodb';
    protected $collection = 'customers';

    protected $fillable = ['name','email','phone'];

    //connect collection cus_Carrenttals
    public function getCusCarrentals(){
        return $this->hasMany(CustomerCarRentals::class, 'cus_id', '_id');
    }
}
