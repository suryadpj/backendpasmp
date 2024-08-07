<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class PartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('part')
                ->leftJoin('kendaraan','kendaraan.id','part.IDKendaraan')
                ->select('part.*','kendaraan.nama')
                ->where('part.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_kendaraan'))) {
                        $data->where('nama', 'like', "%{$request->get('search_kendaraan')}%");
                    }
                    if (!empty($request->has('search_km'))) {
                        $data->where('km', 'like', "%{$request->get('search_km')}%");
                    }
                    if (!empty($request->has('search_part'))) {
                        $data->where('part', 'like', "%{$request->get('search_part')}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('km', function($data) {
                    return number_format($data->km,0);
                })
                ->editColumn('nama', function($data) {
                    switch($data->transmisi) {
                        case 1 : return $data->nama. ' - AT'; break;
                        case 1 : return $data->nama. ' - MT'; break;
                        default : return $data->nama. ' - ALL';
                    }
                })
                ->editColumn('paket', function($data) {
                    switch($data->paket) {
                        case 1 : return 'gold'; break;
                        case 2 : return 'silver'; break;
                        case 3 : return 'gold'; break;
                    }
                })
                ->editColumn('kategori', function($data) {
                    switch($data->paket) {
                        case 1 : return 'tcare'; break;
                        case 2 : return 'non tcare'; break;
                        default : return '-';
                    }
                })
                ->editColumn('qty', function($data) {
                    return number_format($data->qty,0);
                })
                ->editColumn('harga', function($data) {
                    return number_format($data->harga,0);
                })
                ->rawColumns(['action',])
                ->make(true);
        }
        $kendaraan = DB::table('kendaraan')->orderBy('nama')->where('deleted',0)->get();
        $km = DB::table('jasa')->orderBy('km')->distinct('km')->select('km')->where('deleted',0)->get();
        return view('part', compact('kendaraan','km'));
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
            'paket' => 'required',
            'transmisi' => 'required',
            'part' => 'required',
            'kategori' => 'required',
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
            'transmisi' => $request->transmisi,
            'part' => $request->part,
            'km' => $request->km,
            'kategori' => $request->kategori,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('part')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('part')
            ->where('part.id', $id)
            ->where('part.deleted', 0)
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
            'paket' => 'required',
            'transmisi' => 'required',
            'part' => 'required',
            'kategori' => 'required',
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
            'transmisi' => $request->transmisi,
            'part' => $request->part,
            'km' => $request->km,
            'kategori' => $request->kategori,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'deleted' => '0'
        );

        DB::table('part')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('part')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
