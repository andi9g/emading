<?php

namespace App\Http\Controllers;

use App\Models\kontenM;
use App\Models\pengaturanM;
use Illuminate\Http\Request;

class umumC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $pengaturan = pengaturanM::first();
        $konten = kontenM::where("judul", "like", "%$keyword%")
        ->orderBy("idkonten", "desc")
        ->paginate(6);

        $konten->appends($request->only(["limit", "keyword"]));

        return view("pages.client.umum", [
            "pengaturan" => $pengaturan,
            "konten" => $konten,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function baca(Request $request, $idkonten)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $pengaturan = pengaturanM::first();
        $konten = kontenM::where("judul", "like", "%$keyword%")
        ->whereNotIn("idkonten", [$idkonten])
        ->orderBy("idkonten", "desc")
        ->paginate(6);

        $konten->appends($request->only(["limit", "keyword"]));

        $baca = kontenM::where("idkonten", $idkonten)->first();

        return view("pages.client.baca", [
            "pengaturan" => $pengaturan,
            "konten" => $konten,
            "baca" => $baca,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
