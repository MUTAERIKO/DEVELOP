
@extends('layouts.admin')
@section('title','年表・地図つきメモ帳 ~ 観光や歴史の勉強向き ~')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>コンテンツ作成画面</h2>
            <form action="{{ action('Admin\KijiController@create') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
　
                 <div class="form-group row">
                    <label class="col-md-2" for="user_id">id</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="user_id" value="{{ 123 }}">
                    </div>
                 </div>
                 
                 <?php var_dump($user);?>
                 
                 
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="title">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                 </div>
                 
                 
               <div class="form-group row">
                 <label class="col-md-2" for="title">画像</label>
                    <div class="col-md-10">
                        <input type="file" class="form-control-file" name="image" value="{{ old('image') }}">
                    </div>
                 </div>
                 
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="seireki">西暦</label>
                    <div class="col-md-10">
                        <label>年/月/日：<input type="date" class="form-control" name="seireki" value="{{ old('seireki') }}"></label>
                        
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">記事本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="15">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="googlemap">Googlemap</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="Googlemap" rows="5">{{ old('googlemap') }}</textarea>
                        </div>
                    </div>
                    
                    <!--
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    -->
                    
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
            </form>
        </div>
    </div>
</div>
@endsection



<!--
<!COCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>年表・地図つきメモ帳 ~ 観光や歴史の勉強向き ~</title>
    </head>
    <body>
        <h1>コンテンツ作成画面</h1>
    </body>
</html>
-->