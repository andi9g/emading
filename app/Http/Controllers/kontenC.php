<?php

namespace App\Http\Controllers;

use App\Models\kontenM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class kontenC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $data = kontenM::where("judul", "like", "%$keyword%")
        ->orWhere("tags", "like", "%$keyword%")
        ->paginate(15);

        $data->appends($request->only(["limit", "keyword"]));

        return view("pages.konten.konten", [
            "keyword" => $keyword,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.konten.create');
    }


    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $cek = $request->file('upload')->move(\base_path() .'/public/gambar/konten', $fileName);
                    $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                    $url = asset('/gambar/konten/'.$fileName);
                    $msg = 'Gambar Berhasil diupload';
                }else {
                    $CKEditorFuncNum = 1;
                    $url = '';
                    $msg = 'Format bukan gambar';
                }


            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";


            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'tags'=>'required',
            'konten'=>'required',
        ]);


        if($request->hasFile('gambar')) {
            $file = $request->gambar;
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();

            $ex = strtolower($extension);
            if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                if($size > 1024000) {
                    return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                }
                $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;

                $file->move(public_path('gambar/konten'), $filename);

            }else {
                return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
            }

        }else {
            $filename = "default.png";
        }

        $data = $request->all();
        $konten_mentah = $request->konten;
        $konten = trim($konten_mentah);
        $konten = stripslashes($konten);
        $data['konten'] = htmlspecialchars($konten);
        $data["tags"] = implode(",", $request->tags);
        $data["gambar"] = $filename;
        $data['iduser'] = Auth::user()->iduser;


        kontenM::create($data);
        return redirect('konten')->with('success', 'Success');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kontenM  $kontenM
     * @return \Illuminate\Http\Response
     */
    public function show(kontenM $kontenM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kontenM  $kontenM
     * @return \Illuminate\Http\Response
     */
    public function edit(kontenM $kontenM, $idkonten)
    {

        $data = kontenM::where("idkonten", $idkonten)->first();
        return view("pages.konten.update", [
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kontenM  $kontenM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kontenM $kontenM, $idkonten)
    {
        $request->validate([
            'judul'=>'required',
            'tags'=>'required',
            'konten'=>'required',
        ]);

        if($request->hasFile('gambar')) {
            $file = $request->gambar;
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();

            $ex = strtolower($extension);
            if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                if($size > 1024000) {
                    return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                }
                $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;

                $file->move(public_path('gambar/konten'), $filename);

            }else {
                return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
            }

        }else {
            $filename = kontenM::where("idkonten", $idkonten)->first()->gambar;
        }

        $data = $request->all();
        $konten_mentah = $request->konten;
        $konten = trim($konten_mentah);
        $konten = stripslashes($konten);
        $data['konten'] = htmlspecialchars($konten);
        $data["tags"] = implode(",", $request->tags);
        $data["gambar"] = $filename;
        $data['iduser'] = Auth::user()->iduser;


        kontenM::findOrFail($idkonten)->update($data);
        return redirect('konten')->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kontenM  $kontenM
     * @return \Illuminate\Http\Response
     */
    public function destroy(kontenM $kontenM, $idkonten)
    {
        kontenM::destroy($idkonten);
        return redirect()->back()->with('success', 'Success');
    }
}
