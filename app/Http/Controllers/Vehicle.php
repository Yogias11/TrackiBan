<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_m;
use App\Models\VehicleCategory_m;
use App\Models\VehicleRoda_m;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Vehicle extends Controller
{
    function index() {
        $vehicle = Vehicle_m::all();
        $jenis = VehicleCategory_m::all();
        return view('admin.vehicle', compact('vehicle', 'jenis'));
    }

    function store(Request $request){
        try {
            $vehicle = new Vehicle_m();

            $vehicle->jenis_id = $request->jenis_id;
            $vehicle->name = $request->name;
            $vehicle->nopol = $request->nopol;
            $vehicle->jml_roda = $request->jml_roda;
            $vehicle->aktif = 1;
            $vehicle->created_at = Carbon::now();

            $vehicle->save();

            $no_seri = count($request->no_seri);
            for($i = 0; $i < $no_seri; $i++) {
                $roda = new VehicleRoda_m();
                $roda->vehicle_id = $vehicle->id;
                $roda->kontainer = $request->kontainer[$i];
                $roda->roda = $i;
                $roda->no_seri = $request->no_seri[$i];
                $roda->posisi = $request->posisi[$i];
                $roda->status = 0;
                $roda->aktif = 1;
                $roda->created_at = Carbon::now();
                $roda->save();
            }

            return redirect()->route('vehicle.index');
        } catch (\Throwable $th) {
            return redirect()->route('vehicle.index');
        }
    }

    function edit($id){
        $vehicle = Vehicle_m::find($id);
        $jenis = VehicleCategory_m::all();
        $roda = VehicleRoda_m::where('vehicle_id',$id)->get();
        return view('admin.edit.vehicle', compact('vehicle', 'jenis', 'roda'));
    }

    function update(Request $request, $id) {
        try {
            $vehicle = Vehicle_m::find($id);

            $vehicle->jenis_id = $request->jenis_id;
            $vehicle->name = $request->name;
            $vehicle->nopol = $request->nopol;
            $vehicle->jml_roda = $request->jml_roda;
            $vehicle->aktif = 1;
            $vehicle->updated_at = Carbon::now();

            $vehicle->save();

            // $no_seri = count($request->no_seri);
            // if ($no_seri == 0) {
            //     for($i = 0; $i < $no_seri; $i++) {
            //         $roda = VehicleRoda_m::where('vehicle_id',$id)->get();
            //         $roda->vehicle_id = $vehicle->id;
            //         $roda->kontainer = $request->kontainer[$i];
            //         $roda->roda = $i;
            //         $roda->no_seri = $request->no_seri[$i];
            //         $roda->posisi = $request->posisi[$i];
            //         $roda->status = 0;
            //         $roda->aktif = 1;
            //         $roda->created_at = Carbon::now();
            //         $roda->save();
            //     }
            // } else {
            //     $roda = VehicleRoda_m::where('vehicle_id',$id)->get();
            //     $roda->delete();

            // }


            return redirect()->route('vehicle.index');
        } catch (\Throwable $th) {
            return redirect()->route('vehicle.index');
        }
    }

    function destroy($id){
        try {
            $vehicle = Vehicle_m::where('id',$id);
            $roda = VehicleRoda_m::where('vehicle_id', $id);
            $roda->delete();
            $vehicle->delete();

            return redirect()->route('vehicle.index')->with('success', 'Data Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('vehicle.index')->with('warning', $e->getMessage());
        }
    }
}
