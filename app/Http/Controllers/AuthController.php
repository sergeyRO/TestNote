<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    //Регистрация нового пользователя (просто создание)
    public function register(Request $request){
        if(Auth::check()){
            return redirect(route('private'));
        }

        $validateFields=$request->validate([
            'name'=>'required',
            'email' => 'required|email',
            'password'=>'required'
        ]);

        if(User::where('email', $validateFields['email'])->exists()){
            return redirect(route('register'))->withError([
                'email' => 'Такой пользователь уже зарегистрирован'
            ]);
        }

        $user = User::create($validateFields);
        if($user)
        {
            Auth::login($user);
            return redirect(route('notes'));
        }
        return redirect(route('login'))->withErrors([
           'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $formField = $request->only(['email', 'password']);
        if(Auth::attempt($formField))
        {
            return redirect()->intended(route('notes'));
        }

        return redirect(route('login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
}
