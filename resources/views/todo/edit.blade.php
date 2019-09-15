@extends ('layouts.app')　<!--親レイアウトを継承している　更新画面-->
@section ('content')

<h2 class="mb-3">ToDo編集</h2>
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}<!--変更 <form >-->
  <div class="form-group">
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!}<!--変更 <input type="text" class="form-control" placeholder="ToDo内容">-->
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}<!--変更 <button type="submit" class="btn btn-success float-right">更新</button>-->
{!! Form::close() !!} <!--変更 </form>-->

@endsection