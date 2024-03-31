<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\LevelDataTable;
use App\Models\LevelModel;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable){
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama=? where level_kode=?', ['Customer', 'CUS']);
        // return 'Update data berhasil, Jumlah data yang diupdate: '.$row.' baris';

        // $row = DB::delete('delete from m_level where level_kode=?', ['CUS']);
        // return 'Delete data berhasil, Jumlah data yang dihapus: '.$row.' baris';

        return $dataTable->render('level.index');
    }
    public function create(){
        return view('level.create');
    }
    public function store(Request $request){
        $data = [
            'level_kode' => $request->kodeLevel,
            'level_nama' => $request->kodeNama,
        ];
        
        LevelModel::create($data);
        return redirect('/level');
    }
    public function ubah($id){
        $level = LevelModel::find($id);
        return view('level.edit', ['level' => $level]);
    }     
    public function ubah_simpan($id, Request $request){
        $level = levelModel::find($id);
        
        $level->level_kode = $request->kodelevel;
        $level->level_nama = $request->namalevel;

        $level->save();

        return redirect('/level');
    }
    public function hapus($id){
        $level = levelModel::find($id);
        $level->delete();
        return redirect('/level');
    }
}
