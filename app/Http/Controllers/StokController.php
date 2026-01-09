<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list'  => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $stok = DB::table('t_stok')
            ->join('m_barang', 't_stok.barang_id', '=', 'm_barang.barang_id')
            ->join('m_user', 't_stok.user_id', '=', 'm_user.user_id')
            ->select('t_stok.stok_id', 'm_barang.barang_nama', 'm_user.nama as penginput', 't_stok.stok_tanggal', 't_stok.stok_jumlah');

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                // PERBAIKAN: Menggunakan modalAction, bukan link href biasa
                $btn  = '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // --- 1. FITUR TAMBAH ---
    public function create_ajax()
    {
        $barang = DB::table('m_barang')->select('barang_id', 'barang_nama')->get();
        $user = DB::table('m_user')->select('user_id', 'nama')->get(); // Opsional jika ingin pilih user manual

        return view('stok.create_ajax', ['barang' => $barang, 'user' => $user]);
    }

    public function store_ajax(Request $request)
    {
        // Cek validasi
        $validator = Validator::make($request->all(), [
            'barang_id'    => 'required|integer',
            'user_id'      => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }

        // Simpan data
        DB::table('t_stok')->insert([
            'barang_id'    => $request->barang_id,
            'user_id'      => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah'  => $request->stok_jumlah
        ]);

        return response()->json([
            'status' => true,
            'msg'    => 'Data stok berhasil disimpan'
        ]);
    }

    // --- 2. FITUR EDIT ---
    public function edit_ajax(string $id)
    {
        $stok = DB::table('t_stok')->where('stok_id', $id)->first();
        $barang = DB::table('m_barang')->select('barang_id', 'barang_nama')->get();
        $user = DB::table('m_user')->select('user_id', 'nama')->get();

        return view('stok.edit_ajax', ['stok' => $stok, 'barang' => $barang, 'user' => $user]);
    }

    public function update_ajax(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'barang_id'    => 'required|integer',
            'user_id'      => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }

        DB::table('t_stok')->where('stok_id', $id)->update([
            'barang_id'    => $request->barang_id,
            'user_id'      => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah'  => $request->stok_jumlah
        ]);

        return response()->json([
            'status' => true,
            'msg'    => 'Data stok berhasil diupdate'
        ]);
    }

    // --- 3. FITUR HAPUS ---
    public function confirm_ajax(string $id)
    {
        $stok = DB::table('t_stok')
            ->join('m_barang', 't_stok.barang_id', '=', 'm_barang.barang_id')
            ->select('t_stok.*', 'm_barang.barang_nama')
            ->where('stok_id', $id)
            ->first();

        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    public function delete_ajax(Request $request, $id)
    {
        DB::table('t_stok')->where('stok_id', $id)->delete();

        return response()->json([
            'status' => true,
            'msg'    => 'Data berhasil dihapus'
        ]);
    }
}
