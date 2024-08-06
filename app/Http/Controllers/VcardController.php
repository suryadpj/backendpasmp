<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;

class VcardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('members')
                ->select('members.*')
                ->where('deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('member_name'))) {
                        $data->where('member_name', 'like', "%{$request->get('member_name')}%");
                    }

                    if (!empty($request->has('member_title'))) {
                        $data->where('member_title', 'like', "%{$request->get('member_title')}%");
                    }
                })
                ->addColumn('action', function ($data) use ($data_user) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id_members . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id_members . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('kontak_detail', function ($data) use ($data_user) {
                    $detail = 'Kontak : ' . $data->member_phone . ' <br> ';
                    $detail .= 'Email : ' . $data->member_email . ' <br> Alamat : ' . $data->address;
                    return $detail;
                })
                ->rawColumns(['action', 'kontak_detail'])
                ->make(true);
        }
        return view('vcard');
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
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'nama_pejabat' => 'required',
            'jabatan' => 'required',
            'slug' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'akun_ig' => 'required',
            'akun_lkdn' => 'required',
            'file' => 'mimes:pdf,jpg,jpeg,png|max:102400',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('file'))
        {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('file')->storeAs('public/images', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        if(!$request->alamat) {
            $request->alamat = 'Gedung Sainaith Tower Lt.11, Jl. Selangit Kemayoran, Jakarta Pusat, Indonesia';
        }
        if(!$request->website) {
            $request->website = 'https://www.apsupports.com';
        }

        $form_data = array(
            'slug' => $request->slug,
            'member_name' => $request->nama_pejabat,
            'member_title' => $request->jabatan,
            'member_phone' => $request->telp,
            'member_email' => $request->email,
            'member_photo' => $filenameSimpan,
            'address' => $request->alamat,
            'website' => $request->website,
            'ig_account' => $request->akun_ig,
            'linkedin_account' => $request->akun_lkdn,
            'deleted' => '0'
        );

        DB::table('members')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('members')
            ->where('members.id_members', $id)
            ->where('members.deleted', 0)
            ->first();
            return response()->json(['data' => $data]);
        }
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

    public function updatenew(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'nama_pejabat' => 'required',
            'jabatan' => 'required',
            'slug' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'akun_ig' => 'required',
            'akun_lkdn' => 'required',
            'file' => 'mimes:pdf,jpg,jpeg,png|max:102400',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('file'))
        {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('file')->storeAs('public/images', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        $form_data = array(
            'slug' => $request->slug,
            'member_name' => $request->nama_pejabat,
            'member_title' => $request->jabatan,
            'member_phone' => $request->telp,
            'member_email' => $request->email,
            'address' => $request->alamat,
            'website' => $request->website,
            'ig_account' => $request->akun_ig,
            'linkedin_account' => $request->akun_lkdn,
        );

        if(!empty($filenameSimpan))
        {
            $form_data = array_merge($form_data, ['member_photo' => $filenameSimpan]);
        }

        DB::table('members')->where('id_members',$request->hidden_id)->update($form_data);

        return response()->json(['success' => $filenameSimpan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('members')->where('members.id_members',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
