@extends('layouts.admin')
@section('title', 'Add Task')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>タスク登録</h2>
                <form action="{{ action('Admin\TodoController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タスク内容</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-grop row">
                        <label class="col-md-2">期限</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="deadline_date" value="{{ old('deadline_date') }}">
                        </div>
                    </div>
                    <div class="form-grop row">
                        <label class="col-md-2">優先度</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="priority" value="{{ old('priority') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">カテゴリー</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="category_id" value="{{ old('category_id') }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="新規追加">
                    <a href="{{ action('Admin\TodoController@index') }}" role="button" class="btn btn-primary">戻る</a>
                </form>
            </div>
        </div>
    </div>
@endsection
