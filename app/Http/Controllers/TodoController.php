<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo; //追記 AppフォルダのTodoファイルのクラスなどをインポートするために宣言
use Auth; //追記

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ここから追記
    private $todo;

    public function __construct(Todo $instanceClass) //__construct()マジックメソッド
    {
        $this->middleware('auth');//追記　この文でログインしていない場合は、Todoの一覧が表示されなくなります。
        $this->todo = $instanceClass;
    }
    //ここまで追記
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id()); //追記 引数に入っているuser_idのレコードを取得する ここがall()だと全てのアカウントのtodo(値)を取得指定しまう。
        // $todos = $this->todo->all(); //追記 全件取得　SELECT * FROM テーブル名; 全部のレコードを返す。
        // dd($todos); //collectionオブジェクト (インスタンスの集まり)
        // dd(view('todo.index', compact('todos'))); //Viewオブジェクト
        return view('todo.index', compact('todos'));//編集 compact()は引数にとった値をkeyにして同じ名前の変数をvalueにする
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd(view('todo.create'));//Viewオブジェクトでpathが渡される
        return view('todo.create'); //追記 値はブラウザ側に返される
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //以下追記　returnまで
        // dd($request);
        $input = $request->all();
        // dd(Auth::id());//ID番号
        $input['user_id'] = Auth::id();//追記 Auth::id()→現在認証されているユーザーのID取得　取得したIDをuser_idをkeyにして取得したIDを値として代入する
        // dd($input); //連想配列　__token title ID
        $this->todo->fill($input)->save(); //データを追加する命令　INSERT INTO todo(title) VALUES $input　

        // $this->todo->title = 'こんにちは';
        // $this->todo->save();
        return redirect()->to('todo');
        // dd($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //'
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($this->todo->find($id));
        $todo = $this->todo->find($id); //追記　保存されているレコードを取得　SELECT * FROM todos　WHERE id = $id
        // dd(view('todo.edit', compact('todo')));//Viewオブジェクトが返り値として返される。
        return view('todo.edit', compact('todo')); //追記
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //以下追記
        $input = $request->all();
        // dd($this->todo->find($id));//今保存されている指定したidのレコードが帰ってくる Todoオブジェクト
        // dd($this->todo->find($id)->fill($input));//ここでtitleに対して上書きしている
        $this->todo->find($id)->fill($input)->save();//更新を行う命令　UPDATE todos SET title = $input WHERE id = $id saveでtrueが帰ってきている $this->todo->find($id)の返り値のtodoインスタンスかたfillを呼んでる
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //以下追記
        $this->todo->find($id)->delete();//削除命令 DELETE FROM todo WHERE id =$id
        return redirect()->to('todo');
    }
}
