@extends ('layouts.app')　<!--親レイアウトを継承している　一覧画面-->
@section ('content')

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th >ID</th>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo) <!-- $todosはcollectクラスの中にある連想配列　$todoはtodoインスタンス -->
      <tr>
        <td class="align-middle">{{ $todo->id }}</td>
        <td class="align-middle">{{ $todo->title }}</td>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td><!--routeの第一引数は遷移先のページ、第二引数にパラメータを指定-->
        <td>
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!} <!--<button class="btn btn-danger" type="submit">-->
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!} <!--<i class="fas fa-trash-alt"></i>-->
          {!! Form::close() !!}<!--</button>-->
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection