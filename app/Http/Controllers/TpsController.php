<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kabupaten;
use App\kecamatan;
use App\desa;
use App\tp;

class TpsController extends Controller
{
    //
    public function index(){
        $kabupaten=kabupaten::all();
        $kecamatan=kecamatan::leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupaten.id')
                    ->select('kecamatans.*','kabupatens.namakabupaten')
                    ->get();
        $desa=desa::leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                    ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('desas.*','kecamatans.namakecamatan','kabupatens.namakabupaten')
                    ->get();
        $tps=tp::leftJoin('desas','tps.desa_id','=','desas.id')
                ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                ->select('tps.*','desas.namadesas','kecamatans.namakecamatan','kabupatens.kabupaten')
                ->get();            
        return view('tps.index',['kabupatens'=>$kabupaten,'kecamatans'=>$kecamatan,'desas'=>$desa,'tps'=>$tps]);
    }

    public function editkabupaten($id){
        $id=decrypt($id);
        $kabupaten=kabupaten::find($id);
        return view('tps.kabupten',['kabupaten'=>$kabupaten]);
    }

    public function updatekabupaten(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'nama'=>'required',
        ]);

        $table=kabupaten::find($id);
        $table->namakabupaten=$request->nama;
        $table->save();
        return redirect()->back();
    }

    public function editkecamatan($id){
        $id=decrypt($id);
        $kecamatan=kecamatan::find($id);
        return view('tps.kecamatan',['kecamatan'=>$kecamatan]);
    }

    public function updatekecamatan(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'nama'=>'required',
        ]);

        $table=kecamatan::find($id);
        $table->namakecamatan=$request->nama;
        $table->save();
        return redirect()->back();
    }
    
    public function editdesa($id){
        $id=decrypt($id);
        $desa=desa::find($id);
        return view('tps.desa',['desa'=>$desa]);
    }

    public function updatedesa(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'nama'=>'required',
        ]);

        $table=desa::find($id);
        $table->namadesas=$request->nama;
        $table->save();
        return redirect()->back();
    }

    public function deletekabupaten($id){
        $id=decrypt($id);
        $kabupaten=kabupaten::find($id);
        $kabupaten->delete();
        return redirect()->back();
    }

    public function deletekecamatan($id){
        $id=decrypt($id);
        $kecamatan=kecamatan::find($id);
        $kecamatan->delete();
        return redirect()->back();
    }

    public function deletedesa($id){
        $id=decrypt($id);
        $desa=desa::find($id);
        $desa->delete();
        return redirect()->back();
    }

    public function deletetps($id){
        $id=decrypt($id);
        $tps=tps::find($id);
        $tps->delete();
        return redirect()->back();
    }
}
