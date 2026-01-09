<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
{
    $breadcrumb = (object) [
        'title' => 'Daftar User',
        'list' => ['Home', 'User']
    ];

    $page = (object) [
        'title' => 'Daftar user yang terdaftar dalam sistem'
    ];

    $activeMenu = 'user'; // set menu yang sedang aktif

    $level = LevelModel::all(); // ambil data level untuk filter level

    return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
}

    // public function index()
    // {
    //     $user = UserModel::all();
    //     return view('user', ['data' => $user]);
    // }


    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
{
    UserModel::create([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => Hash::make('$request->password'),
        'level_id' => $request->level_id
    ]);

    return redirect('/user');
}

public function ubah($id)
{
    $user = UserModel::find($id);
    return view('user_ubah', ['data' => $user]);
}

public function ubah_simpan($id, Request $request)
{
    $user = UserModel::find($id);

    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->password = Hash::make($request->password);
    $user->level_id = $request->level_id;

    $user->save();

    return redirect('/user');
}

public function hapus($id)
{
    $user = UserModel::find($id);
    $user->delete();

    return redirect('/user');
}

// Ambil data user dalam bentuk json untuk datatables
public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id', 'avatar') // Ambil avatar
            ->with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                // ... tombol aksi ...
                $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            // TAMBAHAN KOLOM GAMBAR
            ->addColumn('avatar', function ($user) {
                if ($user->avatar) {
                    return '<img src="'.asset('storage/photos/'.$user->avatar).'" height="50">';
                }
                return '<img src="'.asset('user_default.png').'" height="50">'; // Gambar default jika kosong
            })
            ->rawColumns(['aksi', 'avatar']) // Render HTML gambar
            ->make(true);
    }

// Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'required|min:5',          // password harus diisi dan minimal 5 karakter
            'level_id' => 'required|integer'         // level_id harus diisi dan berupa angka
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list'  => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list'  => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username KECUALI untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'nullable|min:5',          // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
            'level_id' => 'required|integer'         // level_id harus diisi dan berupa angka
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    // Menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);

        if (!$check) {  // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id); // Hapus data user

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax() {
    $level = LevelModel::select('level_id', 'level_nama')->get();

    return view('user.create_ajax')
                ->with('level', $level);
}

public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama'     => 'required|string|max:100',
                'password' => 'required|min:5',
                'avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120' // Validasi File
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $input = $request->all();

            // PROSES UPLOAD FILE
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                // Simpan ke folder public/storage/photos
                $file->storeAs('public/photos', $filename);
                $input['avatar'] = $filename;
            }

            $input['password'] = Hash::make($request->password);
            UserModel::create($input);

            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

public function edit_ajax(string $id) {
    $user = UserModel::find($id);
    $level = LevelModel::select('level_id', 'level_nama')->get();
    return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
}

public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
                'nama'     => 'required|string|max:100',
                'password' => 'nullable|min:5',
                'avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120' // Validasi File
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                $input = $request->all();

                // JIKA USER UPLOAD FOTO BARU
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/photos', $filename);

                    // HAPUS FOTO LAMA JIKA ADA
                    if ($check->avatar) {
                        Storage::delete('public/photos/' . $check->avatar);
                    }
                    $input['avatar'] = $filename;
                }

                if ($request->password) {
                    $input['password'] = Hash::make($request->password);
                } else {
                    unset($input['password']);
                }

                $check->update($input);
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            }
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/');
    }

public function confirm_ajax(string $id) {
    $user = UserModel::find($id);
    return view('user.confirm_ajax', ['user' => $user]);
}

public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            if ($user) {
                // HAPUS FOTO
                if ($user->avatar) {
                    Storage::delete('public/photos/' . $user->avatar);
                }
                $user->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/');
    }
    //     $user = UserModel::create([
    //         'username' => 'manager11',
    //         'nama' => 'Manager11',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2,
    //     ]);

    // $user->username = 'manager12';

    // $user->save();

    // $user->wasChanged();
    // $user->wasChanged('username');
    // $user->wasChanged(['username', 'level_id']);
    // $user->wasChanged('nama');
    // dd($user->wasChanged(['nama', 'username']));

    // $user->isDirty();
    // $user->isDirty('username');
    // $user->isDirty('nama');
    // $user->isDirty(['nama', 'username']);

    // $user->isClean();
    // $user->isCLean('username');
    // $user->isClean('nama');
    // $user->isClean(['nama', 'username']);

    // $user->isDirty();
    // $user->isClean();
    // dd($user->isDirty());
    // {   $user = UserModel::firstOrNew(
    //     [
    //         'username' => 'manager33',
    //         'nama' => 'Manager Tiga Tiga',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ],
    // );
    // $user->save();
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // $user = UserModel::where ('username', 'manager9')->firstOrFail();
        // $user = UserModel::findOrFail(1);
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {abort(404);});
        // $user = UserModel::findOr(1, ['username', 'nama'], function () {abort(404);});
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);
        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);
        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);
        // $data = [
            // 'level_id' => 2,
            // 'username' => 'manager_tiga',
            // 'nama' => 'manager 3',
            // 'password' => Hash::make('12345'),
        // ];
        // UserModel::create($data);

        // UserModel::where('username', 'customer-1')->update($data);
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 3,
        // ];

        // UserModel::insert($data);

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);
}
