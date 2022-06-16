<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = User::where('name', $request->name)
                ->where('password', $request->password)
                ->get();

            if (count($user) != 1)
                throw new Exception;

            return ["Code" => "200", "Msg" => "Success", "Data" => $user];
        } catch (\Throwable $th) {
            return ["Code" => "500", "Msg" => "Fail"];
        }
    }
}
