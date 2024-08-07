<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('material')
                ->leftJoin('kendaraan','kendaraan.id','material.IDKendaraan')
                ->select('material.*','kendaraan.nama')
                ->where('material.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_kendaraan'))) {
                        $data->where('nama', 'like', "%{$request->get('search_kendaraan')}%");
                    }
                    if (!empty($request->has('search_material'))) {
                        $data->where('material', 'like', "%{$request->get('search_material')}%");
                    }
                })
                ->addColumn('action', function ($data) use ($data_user) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('paket', function($data) {
                    switch($data->paket) {
                        case 1 : return 'gold'; break;
                        case 2 : return 'silver'; break;
                        case 3 : return 'gold'; break;
                    }
                })
                ->editColumn('harga', function($data) {
                    return number_format($data->harga,0);
                })
                ->rawColumns(['action','paket'])
                ->make(true);
        }
        $kendaraan = DB::table('kendaraan')->orderBy('nama')->where('deleted',0)->get();
        return view('material', compact('kendaraan'));
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
            'paket' => 'required',
            'material' => 'required',
            'kendaraan' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'IDKendaraan' => $request->kendaraan,
            'paket' => $request->paket,
            'material' => $request->material,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('material')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('material')
            ->where('material.id', $id)
            ->where('material.deleted', 0)
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
            'paket' => 'required',
            'material' => 'required',
            'kendaraan' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'IDKendaraan' => $request->kendaraan,
            'paket' => $request->paket,
            'material' => $request->material,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('material')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('material')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
