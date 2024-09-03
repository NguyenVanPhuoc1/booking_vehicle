<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\CarsSpecifications;
use App\Models\CarImages;
use App\Models\CarBrand;

class Cars extends Model
{
    use HasFactory;
    // khai báo biến
    protected $connection = 'mongodb';
    protected $collection = 'cars';

    protected $fillable = [];

    // Define the one-to-one relationship
    public function specification()
    {
        return $this->hasOne(CarsSpecifications::class, 'car_slug', 'slug');
    }
    //connect collection car_image
    public function getImageCars(){
        return $this->hasMany(CarImages::class, 'car_id', '_id');
    }
    //connect collection car_brand
    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id', '_id');
    }
}
