<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        // $data = [
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data'=>$user]);

        // $user = UserModel::find(1);
        // $user = UserModel::firstWhere('level_id', 1);
        // $user = UserModel::findOr(20, ['username', 'nama'], function(){
        //     abort(404);
        // });
        // $user = UserModel::findOrFail(1);
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data'=>$user]);
    }
}
