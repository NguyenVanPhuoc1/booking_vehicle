<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\Cars;

class CarBrand extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'car_brand';

    protected $fillable = ['brand_name','brand_slug','noi_bat'];

    public function getCarsbyTypeName(){
        return $this->hasMany(Cars::class, 'brand_id', '_id');
    }
}
