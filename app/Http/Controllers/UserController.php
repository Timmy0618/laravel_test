<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = new User;

            $user->fill($request->only(['name', 'email', 'password']));

            $user->save();

            return ["Code" => "200", "Msg" => "Success"];
        } catch (\Throwable $th) {
            return ["Code" => "500", "Msg" => "Fail"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $user = User::find($id);

            return ["Code" => "200", "Msg" => "Success", "Data" => $user];
        } catch (\Throwable $th) {
            return ["Code" => "500", "Msg" => "Fail"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            $user->fill($request->only(['name', 'password']));

            $user->save();

            return ["Code" => "200", "Msg" => "Success", "Data" => $user];
        } catch (\Throwable $th) {
            return ["Code" => "500", "Msg" => "Fail"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            $user->delete();

            return ["Code" => "200", "Msg" => "Success"];
        } catch (\Throwable $th) {
            return ["Code" => "500", "Msg" => "Fail"];
        }
        //

    }
}
