<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class JasaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('jasa')
                ->leftJoin('kendaraan','kendaraan.id','jasa.IDKendaraan')
                ->select('jasa.*','kendaraan.nama')
                ->where('jasa.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_kendaraan'))) {
                        $data->where('nama', 'like', "%{$request->get('search_kendaraan')}%");
                    }
                    if (!empty($request->has('search_km'))) {
                        $data->where('km', 'like', "%{$request->get('search_km')}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('total', function ($data) {
                    return number_format($data->jasa+$data->ppn,0);
                })
                ->editColumn('km', function($data) {
                    return number_format($data->km,0);
                })
                ->editColumn('jasa', function($data) {
                    return number_format($data->jasa,0);
                })
                ->editColumn('ppn', function($data) {
                    return number_format($data->ppn,0);
                })
                ->rawColumns(['action','total'])
                ->make(true);
        }
        $kendaraan = DB::table('kendaraan')->orderBy('nama')->where('deleted',0)->get();
        $km = DB::table('jasa')->orderBy('km')->distinct('km')->select('km')->where('deleted',0)->get();
        return view('jasa', compact('kendaraan','km'));
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
            'km' => 'required',
            'jasa' => 'required',
            'ppn' => 'required',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'IDKendaraan' => $request->kendaraan,
            'km' => $request->km,
            'jasa' => $request->jasa,
            'ppn' => $request->ppn,
            'deleted' => '0'
        );

        DB::table('jasa')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('jasa')
            ->where('jasa.id', $id)
            ->where('jasa.deleted', 0)
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
            'km' => 'required',
            'jasa' => 'required',
            'ppn' => 'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'IDKendaraan' => $request->kendaraan,
            'km' => $request->km,
            'jasa' => $request->jasa,
            'ppn' => $request->ppn,
            'deleted' => '0'
        );

        DB::table('jasa')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('jasa')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
