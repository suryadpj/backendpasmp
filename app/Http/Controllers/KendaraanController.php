<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class KendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('kendaraan')
                ->where('deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_kendaraan'))) {
                        $data->where('namashow', 'like', "%{$request->get('search_kendaraan')}%");
                    }
                })
                ->addColumn('action', function ($data) use ($data_user) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('gambar', function ($data) {
                    return '<img class="img-thumbnail" width="100" height="100" src="storage/kendaraan/'.$data->source.'">';
                })
                ->rawColumns(['action','gambar'])
                ->make(true);
        }
        return view('kendaraan');
    }
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'namashow' => 'required',
            'nama' => 'required',
            'gambar' => 'required|mimes:pdf,jpg,jpeg,png|max:102400',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('gambar'))
        {
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('gambar')->storeAs('public/kendaraan/', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        $form_data = array(
            'nama' => $request->nama,
            'namashow' => $request->namashow,
            'source' => $filenameSimpan,
            'show' => 1,
            'deleted' => '0'
        );

        DB::table('kendaraan')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('kendaraan')
            ->where('kendaraan.id', $id)
            ->where('kendaraan.deleted', 0)
            ->first();
            return response()->json(['data' => $data]);
        }
    }

    public function updatenew(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'namashow' => 'required',
            'nama' => 'required',
            'gambar' => 'mimes:pdf,jpg,jpeg,png|max:102400',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('gambar'))
        {
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('gambar')->storeAs('public/kendaraan/', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        $form_data = array(
            'nama' => $request->nama,
            'namashow' => $request->namashow,
            'show' => 1,
            'deleted' => '0'
        );

        if(!empty($filenameSimpan))
        {
            $form_data = array_merge($form_data, ['source' => $filenameSimpan]);
        }

        DB::table('kendaraan')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('kendaraan')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
