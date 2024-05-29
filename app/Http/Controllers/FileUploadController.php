<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view('file-upload');
    }
    public function prosesFileUpload(Request $request){
        // return "Pemrosesan file upload di sini";
        // dump($request->berkas);
        // if($request->hasFile('berkas'))
        // {
        //     echo "path(): ".$request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ".$request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginal Extension(): ".
        //         $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ".$request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ".
        //     $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ".$request->berkas->getSize();
        // }
        // else
        // {
        //     echo "Tidak ada berkas yang diupload";
        // }
        $request->validate([
            'berkas'=>'required|file|image|max:500',
            'nama_berkas'=>'required|string'
        ]);
        // $extfile = $request->berkas->getClientOriginalName();
        // $namaFile = 'web-'.time().".".$extfile;

        // $path = $request->berkas->storeAs('public', $namaFile);
        $path = $request->berkas->move('gambar', $request->nama_berkas);
        $path = str_replace("\\", "/", $path);
        echo "Variabel path berisi: $path <br>";

        $pathBaru = asset('gambar/' . $request->nama_berkas);
        echo "Proses upload berhasil, data disimpan pada: $path <br>";
        // echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
        echo "<img src='$pathBaru' alt='Uploaded Image'>";
    }
}
