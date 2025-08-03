<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'car_models';

    protected $primaryKey = 'id';

    // car model belongs to  a car
    public function car(){
        return $this->belongsTo(Car::class);
    }
} 
