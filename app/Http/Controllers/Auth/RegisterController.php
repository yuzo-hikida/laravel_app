<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/todo'; //Register機能　ログイン登録したらtodoリストに遷移する

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //ログインした後にログインページにページを遷移させないようにする
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) //arrayはタイプヒンティング
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255', //リクワイアド
            'email' => 'required|string|email|max:255|unique:users',//unique:テーブル  unique:usersではデータベースのテーブルの指定したカラムで、値がユニークであるか（一意であるか）をチェックできます
            'password' => 'required|string|min:6|confirmed',//コンファームド フィールドがそのフィールド名＋_confirmationフィールドと同じ値であることをバリデートします。例えば、バリデーションするフィールドがpasswordであれば、同じ値のpassword_confirmationフィールドが入力に存在していなければなりません。
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([ //普通にユーザー登録するときのコマンド。コントローラーから呼んだりさます。
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //Hash::make($data['password']) 引数をハッシュ化
        ]);
    }
}
