@extends('layouts.admin')
@section('title', 'Completed ToDo List')

@section('content')
    <div class="container">
        <div class="row">
            <h2>完了済タスク一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoController@index') }}" role="button" class="btn btn-primary">タスク一覧</a>
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
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $to_do)
                                <tr>
                                    <th>{{ $to_do->id }}</th>
                                    <td>{{ \Str::limit($to_do->title, 200) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@delete', ['id' => $to_do->id]) }}">削除</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@uncomplete', ['id' => $to_do->id]) }}">未完了にする</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
