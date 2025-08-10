<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateValidationRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $request->validate([
            'name' => 'required|unique:cars',
            'founded' => 'required|integer|min:0|max:2020',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048'
       ]);

       $newImageName = time(). '-'. $request->name . '.' .
       $request->image->extension();

       $request->image->move(public_path('images'), $newImageName);

        $car = Car::create([
            'name' =>$request->input('name'),
            'founded' =>$request->input('founded'),
            'description' =>$request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id

        ]); 

        return redirect('cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::find($id)->first();

        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateValidationRequest $request, string $id)
    {

        $request->validated();
        // proceed if valid otherwise throw a validationException

        $car = Car::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
            ]
            );

            return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('cars');            
    }
}
