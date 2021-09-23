<?php

namespace App\Http\Controllers;

use App\Models\TrackingBan_m;
use App\Models\TrackingHis_m;
use App\Models\Vehicle_m;
use App\Models\VehicleRoda_m;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingBan extends Controller
{
    function index() {
        $track = TrackingBan_m::where('jenis', '0')->get();
        $vehicle = Vehicle_m::pluck('nopol', 'id', 'name');
        $roda = VehicleRoda_m::all();
        return view('admin.track', compact('track', 'vehicle', 'roda'));
    }

    function getRoda($id) {
        $roda = VehicleRoda_m::select('id', 'no_seri', 'posisi')->where('vehicle_id', $id)->pluck('posisi', 'id');
        return response()->json($roda);
    }

    function show($id) {
        $track = TrackingBan_m::where('id',$id)->get();
        $his = TrackingHis_m::where('track_id', $id)->get();
        // dd($track);
        return view('admin.track_detail', compact('track', 'his'));
    }

    function store(Request $request) {
        try {
            $roda = new TrackingBan_m();

            $roda->vehicle_id = $request->vehicle_id;
            $roda->roda_id = $request->roda_id;
            $roda->jarak = $request->jarak;
            $roda->kontainer = $request->kontainer;
            $roda->posisi = $request->posisi;
            $roda->status = 1;
            $roda->jenis = 0;
            $roda->created_at = Carbon::now();
            $roda->save();

            $his = new TrackingHis_m();
            $his->track_id = $roda->id;
            $his->vehicle_id = $request->vehicle_id;
            $his->roda_id = $request->roda_id;
            $his->jarak = $request->jarak;
            $his->kontainer = $request->kontainer;
            $his->posisi = $request->posisi;
            $his->status = 1;
            $his->jenis = 0;
            $his->created_at = Carbon::now();
            $his->save();

            return redirect()->route('track.index');
        } catch (\Throwable $th) {
            return redirect()->route('track.index');
        }
    }

    function edit($id) {
        $track = TrackingBan_m::find($id);
        $vehicle = Vehicle_m::pluck('nopol', 'id', 'name');
        $roda = VehicleRoda_m::all();
        return view('admin.edit.track', compact('track', 'vehicle', 'roda'));
    }

    function update(Request $request, $id) {
        try {
            $roda = TrackingBan_m::find($id);

            $roda->vehicle_id = $request->vehicle_id;
            $roda->roda_id = $request->roda_id;
            $roda->jarak = $request->jarak;
            $roda->kontainer = $request->kontainer;
            $roda->posisi = $request->posisi;
            $roda->status = 1;
            $roda->jenis = 0;
            $roda->updated_at = Carbon::now();
            $roda->save();

            $his = new TrackingHis_m();
            $his->track_id = $roda->id;
            $his->vehicle_id = $request->vehicle_id;
            $his->roda_id = $request->roda_id;
            $his->jarak = $request->jarak;
            $his->kontainer = $request->kontainer;
            $his->posisi = $request->posisi;
            $his->status = 1;
            $his->jenis = 0;
            $his->created_at = Carbon::now();
            $his->save();

            return redirect()->route('track.index');
        } catch (\Throwable $th) {
            return redirect()->route('track.index');
        }
    }

    function destroy($id) {
        try {
            $track = TrackingBan_m::where('id',$id);
            $his = TrackingHis_m::where('track_id', $id);
            $his->delete();
            $track->delete();

            return redirect()->route('track.index')->with('success', 'Data Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('track.index')->with('warning', $e->getMessage());
        }
    }

    // kontainer
    function kontainer() {
        $track = TrackingBan_m::where('jenis', '1')->get();
        $vehicle = Vehicle_m::pluck('nopol', 'id', 'name');
        $roda = VehicleRoda_m::all();
        return view('admin.kontainer', compact('track', 'vehicle', 'roda'));
    }

    function getKontainer($id) {
        $roda = VehicleRoda_m::select('id', 'kontainer')->groupBy('kontainer')->where('vehicle_id', $id)->pluck('kontainer', 'kontainer');
        return response()->json($roda);
    }

    function detail($id) {

    }

    function create(Request $request) {
        try {
            $roda = new TrackingBan_m();

            $roda->vehicle_id = $request->vehicle_id;
            $roda->jarak = $request->jarak;
            $roda->kontainer = $request->kontainer;
            $roda->status = 1;
            $roda->jenis = 1;
            $roda->created_at = Carbon::now();
            $roda->save();

            $his = new TrackingHis_m();
            $his->track_id = $roda->id;
            $his->vehicle_id = $request->vehicle_id;
            // $his->roda_id = VehicleRoda_m::where('vehicle_id', $request->vehicle_id);
            $his->jarak = $request->jarak;
            $his->kontainer = $request->kontainer;
            // $his->posisi = $request->posisi;
            $his->status = 1;
            $his->jenis = 1;
            $his->created_at = Carbon::now();
            $his->save();

            return redirect()->route('kontainer');
        } catch (\Throwable $th) {
            return redirect()->route('kontainer');
        }
    }

    function ubah($id) {
        $track = TrackingBan_m::find($id);
        $vehicle = Vehicle_m::pluck('nopol', 'id', 'name');
        $roda = VehicleRoda_m::all();
        return view('admin.edit.kontainer', compact('track', 'vehicle', 'roda'));
    }

    function rubah(Request $request, $id) {
        try {
            $roda = TrackingBan_m::find($id);

            $roda->vehicle_id = $request->vehicle_id;
            $roda->jarak = $request->jarak;
            $roda->kontainer = $request->kontainer;
            $roda->posisi = $request->posisi;
            $roda->status = 1;
            $roda->jenis = 1;
            $roda->updated_at = Carbon::now();
            $roda->save();

            $his = new TrackingHis_m();
            $his->track_id = $roda->id;
            $his->vehicle_id = $request->vehicle_id;
            // $his->roda_id = VehicleRoda_m::where('vehicle_id', $request->vehicle_id);
            $his->jarak = $request->jarak;
            $his->kontainer = $request->kontainer;
            $his->posisi = $request->posisi;
            $his->status = 1;
            $his->jenis = 1;
            $his->created_at = Carbon::now();
            $his->save();

            return redirect()->route('kontainer');
        } catch (\Throwable $th) {
            return redirect()->route('kontainer');
        }
    }

    function delete($id) {
        try {
            $track = TrackingBan_m::where('id',$id);
            $his = TrackingHis_m::where('track_id', $id);
            $his->delete();
            $track->delete();

            return redirect()->route('track.index')->with('success', 'Data Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('track.index')->with('warning', $e->getMessage());
        }
    }
}
