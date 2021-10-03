<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use Session;
use App\Models\User;
use App\Models\userdetail;
  

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { 
            //Login Success
            return redirect()->route('Dashboard.index');
        }
        return view('Pages.login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'username'              => 'required|string',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'username.required'     => 'Email wajib diisi',
            'username.username'     => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
        $input=$request->all();
        $validator = Validator::make($input, $rules, $messages);
  
        // Return the value of input when the pass or user is wrong
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $data = [
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
            'NA'        => 'N',
        ];
        
        // Check to database
        Auth::attempt($data);
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('Dashboard.index');
  
        } else { // false
  
            //Login Fail
            Session::flash('error', 'username atau password salah');
            return redirect()->route('login');
        }
  
    }
  
    public function showFormRegister()
    {
        return view('pages/register');
    }
  
    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'nip'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required'
        ];
        
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'nip.required'         => 'Nip Lengkap wajib diisi',
            'nip.min'              => 'Nip lengkap minimal 3 karakter',
            'nip.max'              => 'Nip lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
        ];
  
        // 'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'

        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->username = strtolower($request->nip);
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
        
        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('User.index');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('User.index');
        }
    }
  
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}