<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class authcontroller extends Controller
{
    protected function registerNewAccount(Request $request){
        if(Auth::check()  OR Auth::viaRemember()){
            return redirect(route('index'));
        }
        $validateFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);
        $user = User::create([
            'name' => $validateFields['name'],
            'surname' => $validateFields['surname'],
            'email' => $validateFields['email'],
            'password' => Hash::make($validateFields['password']),
            'role'=> 0,
            'acoin'=> 0,
            'description'=> 'null',
            'stack'=> 'null',
            'contacts'=> 'null',
        ]);
        if($user){
            Auth::login($user);
            return redirect()->to(route('index'));
        }
        return redirect(route(''))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
    protected function loginInAccount(Request $request){
        if(Auth::check()  OR Auth::viaRemember()){
            return redirect(route('index'));
        }
        $formFields = $request->only(['email', 'password']);
        $remember = $request->input('remember');
        if(Auth::attempt($formFields,$remember)){
            return redirect()->intended(route('index'));
        }
        return redirect(route('login'))->withErrors([
            'email'=> 'Не удалось авторизироваться'
        ]);
    }
    protected function logout(Request $request){
        Auth::logout();
        return redirect(route('index'));
    }
}
