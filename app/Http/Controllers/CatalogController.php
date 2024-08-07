<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Data;
use Validator;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data_user = Auth::user();
        if (request()->ajax()) {
            return datatables()->of(DB::table('catalog')
                ->where('deleted',0))
                ->filter(function ($data) use ($request) {
                    if (!empty($request->has('search_judul'))) {
                        $data->where('judul', 'like', "%{$request->get('search_judul')}%");
                    }

                    if (!empty($request->has('search_ringkasan'))) {
                        $data->where('ringkasan', 'like', "%{$request->get('search_ringkasan')}%");
                    }
                })
                ->editColumn('segmen', function($data) {
                    switch($data->segmen) {
                        case 1 : return 'our product'; break;
                        case 2 : return 'service berkala'; break;
                        case 3 : return 'pekerjaan lain'; break;
                        case 4 : return 'body & paint'; break;
                        case 5 : return 'TCO'; break;
                    }
                })
                ->addColumn('action', function ($data) use ($data_user) {
                    $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('catalog');
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
            'segmen' => 'required',
            'judul' => 'required',
            'ringkasan' => 'required',
            'gambardepan' => 'mimes:pdf,jpg,jpeg,png|max:102400',
            'penjelasan' => 'required',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('gambardepan'))
        {
            $filenameWithExt = $request->file('gambardepan')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambardepan')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('gambardepan')->storeAs('public/katalog/gambardepan/', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        //simpan gambar1
        if($request->hasFile('gambar1'))
        {
            $filenameWithExt = $request->file('gambar1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar1')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type1.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar1')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan1="";
        }
        //simpan gambar2
        if($request->hasFile('gambar2'))
        {
            $filenameWithExt = $request->file('gambar2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar2')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type2.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar2')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan2="";
        }
        //simpan gambar3
        if($request->hasFile('gambar3'))
        {
            $filenameWithExt = $request->file('gambar3')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar3')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type3.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar3')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan3="";
        }

        $form_data = array(
            'segmen' => $request->segmen,
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'penjelasan' => $request->penjelasan,
            'gambardepan' => $filenameSimpan,
            'source' => $filenameSimpan1,
            'source2' => $filenameSimpan2,
            'source3' => $filenameSimpan3,
            'deleted' => '0'
        );

        DB::table('catalog')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    public function show($id)
    {
        if(request()->ajax())
        {
            $data = DB::table('catalog')
            ->where('catalog.id', $id)
            ->where('catalog.deleted', 0)
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
            'segmen' => 'required',
            'judul' => 'required',
            'ringkasan' => 'required',
            'gambardepan' => 'mimes:pdf,jpg,jpeg,png|max:102400',
            'penjelasan' => 'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // menyimpan data file yang diupload ke variabel $file
        if($request->hasFile('gambardepan'))
        {
            $filenameWithExt = $request->file('gambardepan')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambardepan')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('gambardepan')->storeAs('public/katalog/gambardepan/', $filenameSimpan);
        }
        else
        {
            $filenameSimpan="";
        }

        //simpan gambar1
        if($request->hasFile('gambar1'))
        {
            $filenameWithExt = $request->file('gambar1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar1')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type1.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar1')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan1="";
        }
        //simpan gambar2
        if($request->hasFile('gambar2'))
        {
            $filenameWithExt = $request->file('gambar2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar2')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type2.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar2')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan2="";
        }
        //simpan gambar3
        if($request->hasFile('gambar3'))
        {
            $filenameWithExt = $request->file('gambar3')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar3')->getClientOriginalExtension();
            $filenameSimpan1 = $request->gambar_type3.'_'.$filename.time().'.'.$extension;
            $path = $request->file('gambar3')->storeAs('public/katalog/konten/', $filenameSimpan1);
        }
        else
        {
            $filenameSimpan3="";
        }

        $form_data = array(
            'segmen' => $request->segmen,
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'penjelasan' => $request->penjelasan,
        );

        if(!empty($filenameSimpan))
        {
            $form_data = array_merge($form_data, ['gambardepan' => $filenameSimpan]);
        }
        if(!empty($filenameSimpan1))
        {
            $form_data = array_merge($form_data, ['source' => $filenameSimpan1]);
        }
        if(!empty($filenameSimpan2))
        {
            $form_data = array_merge($form_data, ['source2' => $filenameSimpan2]);
        }
        if(!empty($filenameSimpan3))
        {
            $form_data = array_merge($form_data, ['source3' => $filenameSimpan3]);
        }

        DB::table('catalog')->where('id',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'data berhasil di update']);
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
        $data = DB::table('catalog')->where('id',$id)->update($form_data);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
