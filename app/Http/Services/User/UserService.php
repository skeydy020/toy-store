<?php

namespace App\Http\Services\User;

use App\Models\GioiTinh;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getRole()
    {
        return Role::where('active', 1)->get();
    }   
    public function getGioiTinh()
    {
        return GioiTinh::where('active', 1)->get();
    }  
    public function insert($request)
    {
        try {
            $request->except('_token');
            // Album::create($request->all());
            User::create([
                'name' => (string)$request->input('name'),
                'email' => (string)$request->input('email'),
                'password' => (string)$request->input('password'),
                'role_id' =>3,
                'thumb' => (int)$request->input('thumb'),
                'SDT' => (string)$request->input('SDT'),
                'GioiTinh' => (string)$request->input('GioiTinh'),
                'SoLuong' => (int)$request->input('SoLuong'),
                'DiaChi' => (string)$request->input('DiaChi')
              
            ]);
            Session::flash('success', 'Thêm mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm LỖI');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function get()
    {
        return User::with('Role')
        ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $user)
    {
        try {
            $user->fill($request->input());
            
            $user->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function webupdate($request, $user)
    {
        try {
            $user = User::find($user); // Tìm người dùng theo ID
            if ($user) {
                $user->fill($request->input()); // Gán dữ liệu mới từ mảng $data
                $user->save();  
            Session::flash('success', 'Cập nhật thành công');}
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function destroy($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if ($user) {
       
            $user->delete();
            return true;
        }

        return false;
    }

    public function show($id)
    {
        return User::where('id', $id)->first();
    }
}
