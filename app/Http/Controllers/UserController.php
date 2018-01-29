<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\role;
use App\tp;
use App\User;
use Symfony\Component\VarDumper\Cloner\Data;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role=role::all();
        $tps=tp::leftJoin('desas','tps.desa_id','=','desas.id')
            ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
            ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
            ->select('tps.*','desas.namadesas','kecamatans.namakecamatan','kabupatens.namakabupaten')
            ->get();
        return view('user.manajemenuser',['roles'=>$role,'tps'=>$tps]);
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
        //
        $rules=array(
            'username'=>'required | min:3 | unique:users',
            'password'=>'required | min:8',
            'role_id'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $username=$request->username;
            $password=$request->password;
            $namauser=$request->namauser;
            $alamatuser=$request->alamatuser;
            $noktpuser=$request->noktpuser;
            $nohpuser=$request->nohpuser;
            $tps_id=$request->tps_id;
            $role_id=$request->role_id;

            if (($namauser=="") || ($alamatuser=="") || ($noktpuser=="") || ($nohpuser=="") || ($tps_id=="")){
                $user = new User();
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->role_id = $request->role_id;
                $user->save();
                return response()->json($user);

            }elseif (($namauser!="") && ($alamatuser!="") && ($noktpuser!="") && ($nohpuser!="") && ($tps_id!=""))
            {
                $user = new User();
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->role_id = $request->role_id;
                $user->namauser=$namauser;
                $user->noktpuser=$noktpuser;
                $user->alamatuser=$alamatuser;
                $user->nohpuser=$nohpuser;
                $user->tps_id=$tps_id;
                $user->alamatuser=$alamatuser;
                $user->save();
                return response()->json($user);
            }

            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function data(){
        $users =User::leftJoin('roles','users.role_id','=','roles.id')
                ->leftJoin('tps','users.tps_id','=','tps.id')
                ->leftJoin('desas','tps.desa_id','=','desas.id')
                ->leftJoin('kecamatans','desas.kecamatan_id','=','kecamatans.id')
                ->leftJoin('kabupatens','kecamatans.kabupaten_id','=','kabupatens.id')
                ->select('users.*','roles.namarole',DB::raw('CONCAT(kabupatens.namakabupaten," >> ",kecamatans.namakecamatan," >> ",desas.namadesas," >> ",tps.namatps) as lokasi'))
                ->get();

        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '<button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-username="'.$users->username.'" data-namauser="'.$users->namauser.'" data-nohpuser="'.$users->nohpuser.'" data-noktpuser="'.$users->noktpuser.'" data-alamatuser="'.$users->alamatuser.'" data-tps_id="'.$users->tps_id.'" data-role_id="'.$users->role_id.'" data-id="'.$users->id.'" data-target="#modal_edit">Edit</button>
                <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-username="'.$users->username.'" data-namauser="'.$users->namauser.'" data-nohpuser="'.$users->nohpuser.'" data-noktpuser="'.$users->noktpuser.'" data-alamatuser="'.$users->alamatuser.'" data-tps="'.$users->tps_id.'" data-role="'.$users->role_id.'" data-id="'.$users->id.'" data-target="#modal_delete">Hapus</button>';
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $rules=array(
            // 'username'=>'required | min:3 | unique:users',
            // 'role_id2'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $username=$request->username2;
            $namauser=$request->namauser2;
            $alamatuser=$request->alamatuser2;
            $noktpuser=$request->noktpuser2;
            $nohpuser=$request->nohpuser2;
            $tps_id=$request->tps_id2;
            $role_id=$request->role_id2;

            // dd($request);

            if (($namauser=="") || ($alamatuser=="") || ($noktpuser=="") || ($nohpuser=="") || ($tps_id=="")){
                $user=User::where('username','=',$username)->first();
                $user->username = $request->username2;
                $user->role_id = $request->role_id2;
                $user->save();
                return response()->json($user);

            }elseif (($namauser!="") && ($alamatuser!="") && ($noktpuser!="") && ($nohpuser!="") && ($tps_id!=""))
            {
                $user=User::where('username','=',$username)->first();
                $user->username = $request->username2;
                $user->role_id = $request->role_id2;
                $user->noktpuser=$noktpuser;
                $user->namauser=$namauser;
                $user->alamatuser=$alamatuser;
                $user->nohpuser=$nohpuser;
                $user->tps_id=$tps_id;
                $user->alamatuser=$alamatuser;
                $user->save();
                return response()->json($user);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $table=User::find($request->deliduser);
        $table->delete();
        return response()->json($table);
    }

    public function indexchange(){

        return view('user.changepassword');
        
      }

    public function changepassword(Request $request){

        // dd("asdads");
            $this->validate($request, [
                'password' => 'required',
                'passwordbaru' => 'required|string|min:8',
                'konfirmasipassword' => 'required|string|min:8|same:passwordbaru'
            ]);
  
            if (Hash::check($request->password,Hash::make($request->password))) {
              // dd("berubah");
              request()->user()->fill([
                  'password' => Hash::make(request()->input('passwordbaru'))
              ])->save();
  
              return redirect()->back()->with('statussucces','Password berhasil di ubah.');
            }
            else{
              return redirect()->back()->with('statuserror','Password Salah');
            }
  
            // return redirect()->route('password.change');
  
      }
}
