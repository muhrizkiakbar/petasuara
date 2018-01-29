<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\kabupaten;
use App\kecamatan;
use App\desa;
use App\tp;
use App\people;
use Datatables;
use Validator;



class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.dashboard');
    }


    // Load Data
    public function data(){

        if ((Auth::user()->role->namarole=="timses") ){
            $orang = DB::raw("(SELECT tps_id,COUNT(tps_id) as jumlah from peoples GROUP BY tps_id) as orangs");
        // dd($orang);

            $peoples =tp::leftJoin($orang,'tps.id','=','orangs.tps_id')
                    ->leftJoin('desas','tps.desa_id','=','desas.id')
                    ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                    ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->where('tps.id','=',Auth::user()->tps->id)
                    ->select('kabupatens.namakabupaten','kecamatans.namakecamatan','desas.namadesas','tps.*','orangs.jumlah')
                    ->get();
        }
        elseif (Auth::user()->role->namarole=="timdes"){
            $orang = DB::raw("(SELECT tps_id,COUNT(tps_id) as jumlah from peoples GROUP BY tps_id) as orangs");
        // dd($orang);
            
            $peoples =tp::leftJoin($orang,'tps.id','=','orangs.tps_id')
                    ->leftJoin('desas','tps.desa_id','=','desas.id')
                    ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                    ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->where('desas.id','=',Auth::user()->tps->desa->id)
                    ->select('kabupatens.namakabupaten','kecamatans.namakecamatan','desas.namadesas','tps.namatps','orangs.jumlah')
                    ->get();
        }
        elseif ((Auth::user()->role->namarole=="gubernur") || (Auth::user()->role->namarole=="superadmin")){
            $orang = DB::raw("(SELECT tps_id,COUNT(tps_id) as jumlah from peoples GROUP BY tps_id) as orangs");
        // dd($orang);
            
            $peoples =tp::leftJoin($orang,'tps.id','=','orangs.tps_id')
                    ->leftJoin('desas','tps.desa_id','=','desas.id')
                    ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                    ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                    ->select('kabupatens.namakabupaten','kecamatans.namakecamatan','desas.namadesas','tps.namatps','orangs.jumlah')
                    ->get();
        }

        // dd($peoples);
        
    
        return Datatables::of($peoples)
            ->make(true);
    }


}
?>