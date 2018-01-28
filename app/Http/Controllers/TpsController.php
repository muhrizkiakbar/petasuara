<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kabupaten;
use App\kecamatan;
use App\desa;
use App\tp;

use Datatables;

class TpsController extends Controller
{
    //
    public function index(){
        
        $kabupaten=kabupaten::all();

        $kecamatan=kecamatan::leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('kecamatans.*','kabupatens.namakabupaten')
                    ->get();

        $desa=desa::leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
        ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
        ->select('desas.*','kecamatans.namakecamatan','kabupatens.namakabupaten')
        ->get();            
        // dd($kabupatenchild);
        $tps=tp::leftJoin('desas','tps.desa_id','=','desas.id')
        ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
        ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
        ->select('tps.*','desas.namadesas','kecamatans.namakecamatan','kabupatens.namakabupaten')
        ->get();   
                 
        // dd($desa);        
        return view('tps.index',['kabupatens'=>$kabupaten,'kecamatans'=>$kecamatan,'desas'=>$desa,'tps'=>$tps]);
    }


    public function datakabupaten(){
        $kabupaten=kabupaten::all();
        return Datatables::of($kabupaten)
            ->addColumn('action', function ($kabupaten) {
                return '<a class="btn-sm btn-success" href="/kabupaten/'.encrypt($kabupaten->id).'">Edit</a>
                <a class="btn-sm btn-danger" data-method="delete"
                   data-token="{{csrf_token()}}" href="/kabupaten/'.encrypt($kabupaten->id).'/delete">Hapus</a>';
            })
            ->make(true);
    }

    public function datakecamatan(){
        $kecamatan=kecamatan::leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('kecamatans.*','kabupatens.namakabupaten')
                    ->distinct('kabupatens.namakabupaten')
                    ->get();
        return Datatables::of($kecamatan)
            ->addColumn('action', function ($kecamatan) {
                return '<a class="btn-sm btn-success" href="/kecamatan/'.encrypt($kecamatan->id).'">Edit</a>
                <a class="btn-sm btn-danger" data-method="delete"
                   data-token="{{csrf_token()}}" href="/kecamatan/'.encrypt($kecamatan->id).'/delete">Hapus</a>';
            })
            ->make(true);
    }

    public function datadesa(){
        $desa=desa::leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                    ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('desas.*','kecamatans.namakecamatan','kabupatens.namakabupaten')
                    ->get();
        return Datatables::of($desa)
            ->addColumn('action', function ($desa) {
                return '<a class="btn-sm btn-success" href="/desa/'.encrypt($desa->id).'">Edit</a>
                <a class="btn-sm btn-danger" data-method="delete"
                   data-token="{{csrf_token()}}" href="/desa/'.encrypt($desa->id).'/delete">Hapus</a>';
            })
            ->make(true);
    }

    public function datatps(){
        $tps=tp::leftJoin('desas','tps.desa_id','=','desas.id')
                ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                ->select('tps.*','desas.namadesas','kecamatans.namakecamatan','kabupatens.namakabupaten')
                ->get();   
        return Datatables::of($tps)
            ->addColumn('action', function ($tps) {
                return '<a class="btn-sm btn-success" href="/tps/'.encrypt($tps->id).'">Edit</a>
                <a class="btn-sm btn-danger" data-method="delete"
                   data-token="{{csrf_token()}}" href="/tps/'.encrypt($tps->id).'/delete">Hapus</a>';
            })
            ->make(true);
    }


    public function postkabupaten(Request $request){
        $this->validate($request, [
            'namakabupaten'=>'required | unique:kabupatens',
        ]);

        $table=new kabupaten;
        $table->namakabupaten=strtoupper($request->namakabupaten);
        $table->save();

        return redirect()->back();

    }

    public function postkecamatan(Request $request){
        $this->validate($request, [
            'kabupaten_id'=>'required',
            'namakecamatan'=>'required | unique:kecamatans',
        ]);

        $table=new kecamatan();
        $table->namakecamatan=strtoupper($request->namakecamatan);
        $table->kabupaten_id=$request->kabupaten_id;
        $table->save();
        return redirect()->back();
    }

    public function postdesa(Request $request){
        $this->validate($request, [
            'kecamatan_id'=>'required',
            'namadesas'=>'required',
        ]);

        $table=new desa();
        $table->namadesas=strtoupper($request->namadesas);
        $table->kecamatan_id=$request->kecamatan_id;
        $table->save();
        return redirect()->back();
    }

    public function posttps(Request $request){
        $this->validate($request, [
            'desa_id'=>'required',
            'namatps'=>'required',
        ]);

        $table=new tp();
        $table->namatps=strtoupper($request->namatps);
        $table->desa_id=$request->desa_id;
        $table->save();
        return redirect()->back();
    }

    public function editkabupaten($id){
        $id=decrypt($id);
        $kabupaten=kabupaten::find($id);
        return view('tps.kabupaten',['kabupaten'=>$kabupaten]);
    }

    public function updatekabupaten(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'namakabupaten'=>'required',
        ]);
        $id=decrypt($request->id);
        $table=kabupaten::find($id);
        $table->namakabupaten=strtoupper($request->namakabupaten);
        $table->save();
        return redirect('/lokasi');
    }

    public function editkecamatan($id){
        $id=decrypt($id);
        $kecamatan=kecamatan::find($id);
        $kabupaten=kabupaten::all();
        return view('tps.kecamatan',['kecamatan'=>$kecamatan,'kabupatens'=>$kabupaten]);
    }

    public function updatekecamatan(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'namakecamatan'=>'required',
        ]);
        
        $id=decrypt($request->id);
        $table=kecamatan::find($id);
        $table->namakecamatan=strtoupper($request->namakecamatan);
        $table->kabupaten_id=$request->kabupaten_id;
        $table->save();
        return redirect('/lokasi');
    }
    
    public function editdesa($id){
        $id=decrypt($id);
        $desa=desa::find($id);
        $kecamatan=kecamatan::leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('kecamatans.*','kabupatens.namakabupaten')
                    ->get();
        return view('tps.desa',['desa'=>$desa,'kecamatans'=>$kecamatan]);
    }

    public function updatedesa(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'namadesas'=>'required',
        ]);
        
        $id=decrypt($request->id);
        $table=desa::find($id);
        $table->namadesas=strtoupper($request->namadesas);
        $table->kecamatan_id=$request->kecamatan_id;
        $table->save();
        return redirect('/lokasi');
    }

    public function edittps($id){
        $id=decrypt($id);
        $tps=tp::find($id);
        $desa=desa::leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                ->select('desas.*','kecamatans.namakecamatan','kabupatens.namakabupaten')
                ->get();    
        return view('tps.tps',['tp'=>$tps,'desas'=>$desa]);

    }

    public function updatetps(Request $request){
        $this->validate($request, [
            'id'=>'required',
            'namatps'=>'required',
        ]);
        
        $id=decrypt($request->id);
        $table=tp::find($id);
        $table->namatps=strtoupper($request->namatps);
        $table->desa_id=$request->desa_id;
        $table->save();
        return redirect('/lokasi');
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
        $tps=tp::find($id);
        $tps->delete();
        return redirect()->back();
    }
}
