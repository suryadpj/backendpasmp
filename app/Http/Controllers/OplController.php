<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class OplController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('opl')
                ->leftJoin('kendaraan','kendaraan.id','opl.IDKendaraan')
                ->select('opl.*','kendaraan.nama')
                ->where('opl.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_kendaraan'))) {
                        $data->where('nama', 'like', "%{$request->get('search_kendaraan')}%");
                    }
                    if (!empty($request->has('search_opl'))) {
                        $data->where('opl', 'like', "%{$request->get('search_opl')}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('harga', function($data) {
                    return number_format($data->harga,0);
                })
                ->editColumn('paket', function($data) {
                    switch($data->paket) {
                        case 1 : return 'gold'; break;
                        case 2 : return 'silver'; break;
                        case 3 : return 'gold'; break;
                    }
                })
                ->rawColumns(['action',])
                ->make(true);
        }
        $kendaraan = DB::table('kendaraan')->orderBy('nama')->where('deleted',0)->get();
        return view('opl', compact('kendaraan'));
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
            'kendaraan' => 'required',
            'paket' => 'required',
            'opl' => 'required',
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
            'opl' => $request->opl,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('opl')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('opl')
            ->where('opl.id', $id)
            ->where('opl.deleted', 0)
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
            'kendaraan' => 'required',
            'paket' => 'required',
            'opl' => 'required',
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
            'opl' => $request->opl,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('opl')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('opl')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
