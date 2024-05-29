<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DetailTransaksiModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\StokModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class TransaksiController extends Controller
{
    public function index(){
        $breadcrumb = (object) [ 
            'title' => 'Daftar Transaksi', 
            'list' => ['Home', 'Transaksi']
        ];
        $page = (object) [ 
            'title' => 'Daftar transaksi yang terdaftar dalam sistem' 
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        $trans = TransaksiModel::all();
        $user = UserModel::all();

        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $trans, 'user'=>$user, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request){
        $trans = TransaksiModel::select('penjualan_id', 'penjualan_kode', 'user_id', 'pembeli','penjualan_tanggal')
                ->with('user');

        //Filter berdasarkan user
        if($request->user_id){
            $trans->where('user_id', $request->user_id);
        }

        return DataTables::of($trans)
        ->addIndexColumn()
        ->addColumn('aksi', function ($tran) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/transaksi/' . $tran->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
            // $btn .= '<a href="'.url('/transaksi/' . $tran->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/transaksi/'.$tran->penjualan_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    public function create(){
        $breadcrumb = (object) [
        'title' => 'Tambah Transaksi',
        'list' => ['Home', 'Transaksi', 'Tambah']];
        $page = (object) [
            'title' => 'Tambah transaksi baru'
        ];
        $user = UserModel::all(); // ambil data level untuk ditampilkan di form $activeMenu 'user'; // set menu yang sedang aktif
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        // Mengambil ID transaksi terakhir
        $counter = (TransaksiModel::selectRaw("CAST(RIGHT(penjualan_kode, 3) AS UNSIGNED) AS counter")->orderBy('penjualan_id', 'desc')->value('counter')) + 1;
        $penjualan_kode = 'PJL' . sprintf("%03d", $counter);
        
        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu, 'lastID' => $penjualan_kode]);
    }
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
            'pembeli' => 'required|string',
            'penjualan_tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'harga' => 'required|array', // Update validasi untuk mencocokkan struktur array
            'jumlah' => 'required|array|min:1',
        ]);
        
        // Array untuk menyimpan barang yang stoknya tidak mencukupi
        $failedTransactions = [];
    
        // Periksa ketersediaan stok sebelum membuat transaksi
        foreach ($request->barang_id as $index => $barang_id) {
            // Ambil jumlah stok barang yang tersedia
            $stok = StokModel::where('barang_id', $barang_id)->first();
    
            if ($stok && $request->jumlah[$index] > $stok->stok_jumlah) {
                // Tambahkan barang yang stoknya tidak mencukupi ke array failedTransactions
                $failedTransactions[] = $barang_id;
            }
        }
    
        // Jika ada barang yang stoknya tidak mencukupi, kembalikan dengan pesan kesalahan
        if (!empty($failedTransactions)) {
            return redirect('/transaksi')->with('error', 'Transaksi gagal. Jumlah stok barang tidak mencukupi untuk barang-barang berikut: ' . implode(', ', $failedTransactions));
        }
    
        // Jika semua stok mencukupi, buat transaksi dan detail transaksi
        $trans = TransaksiModel::create([
            'user_id' => $request->user_id,
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);
    
        // Simpan detail penjualan
        foreach ($request->barang_id as $index => $barang_id) {
            DetailTransaksiModel::create([
                'penjualan_id' => $trans->penjualan_id,
                'barang_id' => $barang_id,
                'harga' => $request->harga[$index],
                'jumlah' => $request->jumlah[$index],
            ]);
    
            // Kurangi jumlah yang dibeli dari jumlah stok yang tersedia
            $stok = StokModel::where('barang_id', $barang_id)->first();
            $stok->stok_jumlah -= $request->jumlah[$index];
            $stok->save();
        }
    
        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }    
    public function show(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id); 

        $detail = DetailTransaksiModel::with('barang', 'transaksi')
        ->where('penjualan_id', $id)
        ->get();
        
        $breadcrumb = (object) [
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        
        return view('transaksi.show', compact('breadcrumb', 'page', 'transaksi', 'activeMenu', 'detail'));
    }
    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        $user = UserModel::all();
        $breadcrumb = (object)[
            'title' => 'Edit Transaksi',
            'list' => ['Home', 'Transaksi', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Transaksi'
        ];
        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        return view('transaksi.edit', compact('breadcrumb', 'page', 'transaksi', 'user', 'activeMenu'));
    }

// Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string',
            'pembeli' => 'required|string',
            'penjualan_tanggal' => 'nullable|date'
        ]);

        $tran = TransaksiModel::find($id);
        $tran->update([
            'user_id' => $request->user_id,
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal ? $request->penjualan_tanggal : $tran->penjualan_tanggal
        ]);

        return redirect('/transaksi')->with('success', 'Data transaksi berhasil diubah');
    }
    public function destroy(string $id)
    {
        $check = TransaksiModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }
        try {
            DetailTransaksiModel::where('penjualan_id', $id)->delete();
            $check->delete();   
            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        } catch (QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    } 
}
