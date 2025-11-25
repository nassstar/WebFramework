<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::where ('username', 'manager9')->firstOrFail();
        // $user = UserModel::findOrFail(1);
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {abort(404);});
        // $user = UserModel::findOr(1, ['username', 'nama'], function () {abort(404);});
        return view('user', ['data' => $user]);
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
}
