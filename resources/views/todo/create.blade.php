@extends ('layouts.app')　<!--親レイアウトを継承している　新規作成-->
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{{ Form::open(['route' => 'todo.store']) }} <!-- 変更 <form>-->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}<!-- 変更 <input type="text" class="form-control" placeholder="ToDo内容">
  </div>-->
  </div>
  {{ Form::submit('追加', ['class' => 'btn btn-success float-right']) }} <!-- 変更 <button type="submit" class="btn btn-success float-right">追加</button>-->
{{ Form::close() }}<!--変更 </form>-->

@endsection