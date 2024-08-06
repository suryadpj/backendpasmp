<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function profile()
    {
        $data = DB::table('users')->where('ID',Auth::id())->first();
        return view('profile',['data' => $data]);
    }
    public function profilesave(request $request)
    {
        $rules = array(
            'name'    =>  'required',
            'username'     =>  'required'
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->password1 != "" || $request->password2 != "")
        {
            $rules = array(
                'password1'    =>  'required',
                'password2'     =>  'required'
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            if($request->password1 == $request->password2)
            {
                $form_data = array(
                    'name'  =>  $request->name,
                    'username'     =>  $request->username,
                    'password' => Hash::make($request->password1),
                );
            }else
            {
                return response()->json(['errors' => 'Password tidak sama, silahkan periksa kembali']);
            }
        }else
        {
            $form_data = array(
                'name'  =>  $request->name,
                'username'     =>  $request->username,
            );
        }


        DB::table('users')->where('ID',$request->id)->update($form_data);

        return response()->json(['success' => 'Data berhasil di update. Silahkan login kembali.']);
    }
}
