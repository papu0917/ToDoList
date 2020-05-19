@extends('layouts.admin')
@section('title', 'ToDo Edit')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>タスク編集</h2>
                <form action="{{ action('Admin\TodoController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タスク内容</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $to_do_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="deadline_date">期限</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="deadline_date" value="{{ $to_do_form->deadline_date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="priority">優先度</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="priority" value="{{ $to_do_form->priority }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="priority">カテゴリー</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="category_id" value="{{ $to_do_form->category_id }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $to_do_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                            <a href="{{ action('Admin\TodoController@index') }}" role="button" class="btn btn-primary">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection