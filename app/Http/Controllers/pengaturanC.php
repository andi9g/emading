<?php

namespace App\Http\Controllers;

use App\Models\pengaturanM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $keyword = empty($request->keyword)?'':$request->keyword;

        $data = pengaturanM::first();

        return view('pages.pengaturan.pengaturan', [
            "data" => $data,
        ]);
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
        $request->validate([
            'namawebsite'=>'required',
            'deskripsi'=>'required',
        ]);

        try{
            $data = $request->all();
            $cek = pengaturanM::count();

            if($request->hasFile('logo')) {
                $file = $request->logo;
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();

                $ex = strtolower($extension);
                if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                    if($size > 1024000) {
                        return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                    }
                    $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;

                    $file->move(public_path('gambar/logo'), $filename);

                }else {
                    return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
                }

            }

            if($cek > 0) {
                $pengaturan = pengaturanM::first();
                if(!($request->hasFile('logo'))) {
                    $filename = $pengaturan->logo;
                }

                $data["logo"] = $filename;
                pengaturanM::truncate();
                pengaturanM::create($data);
                return redirect()->back()->with('success', 'Success');
            }else {
                if(!($request->hasFile('logo'))) {
                    $filename = "logo.png";
                }
                $data["logo"] = $filename;

                pengaturanM::create($data);
                return redirect()->back()->with('success', 'Success');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function show(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function edit(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengaturanM $pengaturanM)
    {
        //
    }
}
