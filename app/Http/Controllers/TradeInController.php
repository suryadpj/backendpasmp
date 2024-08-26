<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class TradeInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('tradeincar')
                ->where('tradeincar.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_merk'))) {
                        $data->where('merk', 'like', "%{$request->get('search_merk')}%");
                    }
                    if (!empty($request->has('search_model'))) {
                        $data->where('model', 'like', "%{$request->get('search_model')}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->ID . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->ID . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('harga_min', function($data) {
                    return number_format($data->harga_min,0);
                })
                ->editColumn('harga_max', function($data) {
                    return number_format($data->harga_max,0);
                })
                ->editColumn('transmisi', function($data) {
                    switch($data->transmisi) {
                        case 1 : return 'AT'; break;
                        case 2 : return 'MT'; break;
                        default : '-';
                    }
                })
                ->rawColumns(['action','harga_min','harga_max'])
                ->make(true);
        }
        return view('tradein');
    }
    public function indexdata(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('tradeindata')
                ->where('tradeindata.deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_merk'))) {
                        $data->where('merk', 'like', "%{$request->get('search_merk')}%");
                    }
                    if (!empty($request->has('search_model'))) {
                        $data->where('model', 'like', "%{$request->get('search_model')}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->ID . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->ID . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('transmisi', function($data) {
                    switch($data->transmisi) {
                        case 1 : return 'AT'; break;
                        case 2 : return 'MT'; break;
                        default : '-';
                    }
                })
                ->rawColumns(['action',])
                ->make(true);
        }
        return view('tradeindata');
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
            'merk' => 'required',
            'type' => 'required',
            'model' => 'required',
            'tahun' => 'required',
            'transmisi' => 'required',
            'harga_min' => 'required',
            'harga_max' => 'required',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'type' => $request->type,
            'transmisi' => $request->transmisi,
            'harga_min' => $request->harga_min,
            'harga_max' => $request->harga_max,
            'deleted' => '0'
        );

        DB::table('tradeincar')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('tradeincar')
            ->where('tradeincar.ID', $id)
            ->where('tradeincar.deleted', 0)
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
            'merk' => 'required',
            'type' => 'required',
            'model' => 'required',
            'tahun' => 'required',
            'transmisi' => 'required',
            'harga_min' => 'required',
            'harga_max' => 'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'type' => $request->type,
            'transmisi' => $request->transmisi,
            'harga_min' => $request->harga_min,
            'harga_max' => $request->harga_max,
            'deleted' => '0'
        );

        DB::table('tradeincar')->where('ID',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
    }
    public function destroy($id)
    {
        $form_data = array(
            'deleted'  =>  '1'
        );
        $data = DB::table('tradeincar')->where('ID',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
