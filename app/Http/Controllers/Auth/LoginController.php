<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; //vendor/laravel/framework/src/Illuminate/Fundation/Auth/AuthenticatesUsers.phpを表している
use Illuminate\Http\Request;  // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; //オーセンティケイツユーザー
    protected $maxAttempts = 2; //ログインを3回失敗すると１分間１分間ロックがかかる ThrottlesLogins.phpでメソッドが定義されていてその値に対してオーバーライドしている。

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';//homeから変更 ドメインが/todoになり一覧ページに行く

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}

