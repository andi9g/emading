<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class penggunaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $data = User::where("name", "like", "%$keyword%")
        ->orderBy("name", "ASC")
        ->paginate(15);

        $data->appends($request->only(["keyword", "limit"]));

        return view("pages.pengguna.pengguna", [
            "data" => $data,
            "keyword" => $keyword,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request, $iduser)
    {
        $SPass = "admin".date("Y");
        $password = Hash::make($SPass);

        User::findOrFail($iduser)->update(["password" => $password]);

        return redirect()->back()->with('warning', "Password berhasil di reset menjadi <br><h2>$SPass</h2>");

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
            'name'=>'required',
            'username'=>'required',
            'posisi'=>'required',
            'email'=>'required',
        ]);

        try{
            $data = $request->all();
            $data["password"] = Hash::make("admin".date('Y'));

            User::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource inemailuest, User $user, $iduser)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'posisi'=>'required',
        ]);

        try{
            $data = $request->all();

            User::findOrFail($iduser)->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $iduser)
    {
        try{
            User::destroy($iduser);
            return redirect()->back()->with('warning', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
