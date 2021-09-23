<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory_m;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VehicleCategory extends Controller
{
    function index() {
        $vehicle = VehicleCategory_m::all();
        return view('admin.vehicle_cat', compact('vehicle'));
    }

    function getData(Request $request, VehicleCategory_m $vehicle) {
        $data = $vehicle->getData();
        return DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditArticleData" data-id="'.$data->id.'"><span class="fa fa-pencil"></span></button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm" id="getDeleteId"><span class="fa fa-trash-o"></span></button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    function store(Request $request){
        try {
            $vehicle = new VehicleCategory_m();
            $vehicle->name = $request->name;
            $vehicle->created_at = Carbon::now();
            $vehicle->save();

            return redirect()->route('vehicleCat.index');
        } catch (\Exception $e) {
            return redirect()->route('vehicleCat.index');
        }
    }

    function edit($id){
        $v = VehicleCategory_m::find($id);
        return view('admin.edit.vehicle_cat', compact('v'));
    }

    function update(Request $request, $id) {
        try {
            $vehicle = VehicleCategory_m::find($id);
            $vehicle->name = $request->name;
            $vehicle->updated_at = Carbon::now();
            $vehicle->save();

            return redirect()->route('vehicleCat.index');
        } catch (\Exception $e) {
            return redirect()->route('vehicleCat.index');
        }
    }

    function destroy($id){
        try {
            $vehicle = VehicleCategory_m::where('id',$id);
            $vehicle->delete();

            return redirect()->route('vehicleCat.index')->with('success', 'Data Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('vehicleCat.index')->with('warning', $e->getMessage());
        }
    }
}
