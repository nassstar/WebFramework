<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list'  => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualan = DB::table('t_penjualan')
            ->join('m_user', 't_penjualan.user_id', '=', 'm_user.user_id')
            ->select('t_penjualan.penjualan_id', 'm_user.nama as kasir', 't_penjualan.pembeli', 't_penjualan.penjualan_kode', 't_penjualan.penjualan_tanggal');

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                // Tombol Detail memanggil show_ajax
                $btn = '<button onclick="modalAction(\''.url('/penjualan/' . $row->penjualan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // === INI METHOD YANG KITA TAMBAHKAN ===
    public function show_ajax(string $id)
    {
        // 1. Ambil data transaksi penjualan (Header)
        $penjualan = DB::table('t_penjualan')
            ->join('m_user', 't_penjualan.user_id', '=', 'm_user.user_id')
            ->select('t_penjualan.*', 'm_user.nama as kasir')
            ->where('penjualan_id', $id)
            ->first();

        // 2. Ambil detail barang yang dijual pada transaksi tersebut (Detail Barang)
        $detail = DB::table('t_penjualan_detail')
            ->join('m_barang', 't_penjualan_detail.barang_id', '=', 'm_barang.barang_id')
            ->select('t_penjualan_detail.*', 'm_barang.barang_nama', 'm_barang.barang_kode')
            ->where('penjualan_id', $id)
            ->get();

        // 3. Tampilkan halaman modal (show_ajax.blade.php)
        return view('penjualan.show_ajax', ['penjualan' => $penjualan, 'detail' => $detail]);
    }
}
