<?php

namespace App\Http\Controllers;

use App\Models\CarDetail;
use Illuminate\Http\Request;

class CarDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('car.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $check = CarDetail::where('plate_no', $request->plate)->first();
        if($check) {
            return response()->json(['error' => 'Opps.. Plate Number is Already recorded']);
        }
        else {

            $car = new CarDetail;
            $car->plate_no = $request->plate;
            $car->current_color = $request->current_color;
            $car->target_color = $request->target_color;
            $car->save();

            return response()->json(['success' => 'New Car successfully Added']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarDetail  $carDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CarDetail $carDetail)
    {
        $allcar = CarDetail::all();

        $cardetails = CarDetail::where('status', 0)->get();

        return view('car.show', compact('cardetails', 'allcar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarDetail  $carDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CarDetail $carDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarDetail  $carDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarDetail $carDetail)
    {
        $car = CarDetail::find($request->id);
        $car->status = 1;
        $car->save();
        return response()->json(['success' => 'Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarDetail  $carDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarDetail $carDetail)
    {
        //
    }
}
