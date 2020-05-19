@extends('layouts.admin')
@section('title', 'ToDo List')

@section('content')
    <div class="container">
        <div class="row">
            <h2>タスク一覧</h2>
        </div>
        <form action="{{ action('Admin\TodoController@index') }}" method="get">
            <select name="order">
                <option>並び替える</option>
                <option value="desc">優先度高い順</option>
                <option value="asc">優先度低い順</option>
            </select>
            <input type="submit" class="btn btn-primary" value="実行">
        </form>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoController@add') }}" role="button" class="btn btn-primary">新規作成</a>
                <a href="{{ action('Admin\TodoController@completed') }}" role="button" class="btn btn-primary">完了済タスク</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\TodoController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">NO</th>
                                <th width="20%">タイトル</th>
                                <th width="20%">期限日</th>
                                <th width="20%">優先度</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $to_do)
                                @if (now() > $to_do->deadline_date)
                                    <tr class="bg-warning">
                                @else
                                    <tr>
                                @endif
                                    <th>{{ $to_do->id }}</th>
                                    <td>{{ \Str::limit($to_do->title, 200) }}</td>
                                    <td>{{ $to_do->deadline_date->format('Y/m/d') }}</td>
                                    <td>{{ $to_do->priority }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@edit', ['id' => $to_do->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@delete', ['id' => $to_do->id]) }}">削除</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@complete', ['id' => $to_do->id]) }}">完了</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $posts->links() }}  
    </div>
@endsection
