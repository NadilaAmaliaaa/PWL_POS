<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable){
        // $user = UserModel::all();
        // return view('user', ['data'=>$user]);

        return $dataTable->render('user.index');
    }
    public function tambah(){
        return view('user.create');
    }
    public function store(Request $request){
        // UserModel::create([
        //     'username'=>$request->username,
        //     'nama'=>$request->nama,
        //     'password'=>Hash::make('$request->password'),
        //     'level_id'=>$request->level_id
        // ]);
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'levelId' => 'required',
        ]);
        return redirect('/user');
    }
    public function ubah($id){
        $user = UserModel::find($id);
        return view('user.edit', ['data'=>$user]);
    }
    public function ubah_simpan($id, Request $request){
        $user = UserModel::find($id);
        
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }
    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }





    // public function index(){
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
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ]
        // );

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ]
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();
        // return view('user', ['data'=>$user]);
    // }

    // public function index(){
    //     $user = UserModel::firstOrNew([
    //             'username' => 'manager55',
    //             'nama' => 'Manager55',
    //             'password' => Hash::make('12345'),
    //             'level_id' => 2
    //     ]);

    //     $user->username = 'manager55';

    //     $user->isDirty(); //true
    //     $user->isDirty('username'); //false
    //     $user->isDirty('nama'); //true
    //     $user->isDirty(['nama', 'username']); //true
        
    //     $user->isClean(); //false
    //     $user->isClean('username'); //true
    //     $user->isClean('nama'); //true
    //     $user->isClean(['nama', 'username']); //false

    //     $user->save();

    //     $user->isDirty(); //false
    //     $user->isClean(); //true
    //     dd($user->isDirty());
    // }
    // public function index(){
    //     $user = UserModel::create([
    //             'username' => 'manager11',
    //             'nama' => 'Manager11',
    //             'password' => Hash::make('12345'),
    //             'level_id' => 2
    //     ]);

    //     $user->username = 'manager12';

    //     $user->save();

    //     $user->wasChanged(); // true
    //     $user->wasChanged('username'); // true
    //     $user->wasChanged(['username', 'level_id']); // true
    //     $user->wasChanged('nama'); // false
    //     dd($user->wasChanged(['nama', 'username'])); // true
    // }
}

