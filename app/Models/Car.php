<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    // car has many models
    public function carModels(){
        return $this->hasMany(CarModel::class);
    }

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }
    // define a has many through relationship
    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id', // foreign key on CarModel table
            'model_id' // foreign key on engine table
            );
    }

    // Define a has one through relationship
    public function productionDate(){
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id', // foreign key on carModel table
            'model_id' // foreign key on carproductiondate table
        );
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}