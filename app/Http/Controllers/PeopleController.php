<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\tp;
use App\people;
use Datatables;
use Validator;



class PeopleController extends Controller
{
    public function index(){

        return view('people.inputpeople');
    }


    public function store(Request $request)
    {
        //
        // dd ('xxx');
        $rules=array(
            'noktp'=>'required',
            'alamat'=>'required',
            'noktp'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $nama=$request->nama;
            $alamat=$request->alamat;
            $noktp=$request->noktp;
            $nohp=$request->nohp;
            $tps_id=Auth::user()->tps_id;

            // dd($tps_id);

            if (($nama=="") || ($alamat=="") || ($noktp=="") || ($nohp=="") || ($tps_id==""))
            {
                $people = new people();
                $people->nama = $nama;
                $people->alamat = $alamat;
                $people->noktp = $noktp;
                $people->tps_id = $tps_id;
                $people->save();
                return response()->json($people);
            }
            if (($nama!="") && ($alamat!="") && ($noktp!="") && ($nohp!="") && ($tps_id!="")) 
            {
                $people = new people();
                $people->nama = $nama;
                $people->alamat=$alamat;
                $people->noktp=$noktp;
                $people->nohp=$nohp;
                $people->tps_id = $tps_id;
                $people->save();
                return response()->json($people);
            }
        }
    }

    // Load Data
    public function data(){
        $peoples =people::leftJoin('tps','peoples.tps_id','=','tps.id')
                ->where('tps_id','=',Auth::user()->tps_id)
                ->select('peoples.*','tps.namatps')
                ->get();

        return Datatables::of($peoples)
            ->addColumn('action', function ($peoples) {
                return '<button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-nama="'.$peoples->nama.'" data-alamat="'.$peoples->alamat.'" data-noktp="'.$peoples->noktp.'" data-nohp="'.$peoples->nohp.'" data-id="'.$peoples->id.'" data-target="#modal_edit">Edit</button>
                <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-nama="'.$peoples->nama.'" data-alamat="'.$peoples->alamat.'" data-noktp="'.$peoples->noktp.'" data-nohp="'.$peoples->nohp.'" data-id="'.$peoples->id.'" data-target="#modal_delete">Hapus</button>';
            })
            ->make(true);
    }


    

    // Update Data
    public function update(Request $request)
    {
        //
        // dd($request);
        $rules=array(
            'namaedit'=>'required',
            'alamatedit'=>'required',
            'noktpedit'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else{
            
            $nama=$request->namaedit;
            $alamat=$request->alamatedit;
            $noktp=$request->noktpedit;
            $nohp=$request->nohpedit;
            $id=$request->idpeople;

            if (($nama=="") || ($alamat=="") || ($noktp=="") || ($nohp==""))
            {
                $people = people::where('id','=',$id)->first();
                $people->nama = $nama;
                $people->alamat = $alamat;
                $people->noktp = $noktp;
                $user->save();
                return response()->json($people);
            }

            elseif (($nama!="") && ($alamat!="") && ($noktp!="") && ($nohp!=""))
            {
                $people=people::where('id','=',$id)->first();
                $people->nama = $nama;
                $people->alamat=$alamat;
                $people->noktp=$noktp;
                $people->nohp=$nohp;
                $people->save();
                return response()->json($people);
            }
        }

    }

    // Delete Data
    public function destroy(Request $request)
    {
        //
        $table=people::find($request->delidpeople);
        $table->delete();
        return response()->json($table);
    }
}
?>