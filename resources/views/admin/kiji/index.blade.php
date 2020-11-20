
@extends('layouts.admin')
@section('title','【一覧】年表・地図つきメモ帳 ~ 観光や歴史の勉強向き ~')

@section('content')
<div class="container">
    <div class="row">
        <h2>コンテンツ一覧</h2>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\KijiController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <div class="col-md-8">
                <form action="{{ action('Admin\KijiController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value=" {{ $cond_title }}">
                        </div>
                        
                        
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                    </form>
            </div>
        </div>
            
            
            <div style="margin-bottom:5rem;"></div>
        
          <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        
                      
                    <ul class ="grid-top">
                     @foreach($posts as $content)
                       <li>
                           <div class="title-on">
                               <a href={{ action('Admin\KijiController@show', ['id' => $content->id]) }}>
                               <img src="{{ asset('storage/image/' . $content->image_path) }}" class="mainpageimage">
                               </a>
                               <p>{{ $content->title }}</p>
                           </div>
                       </li>
                       
                    @endforeach
                    </ul>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>    
            
            <!--
                 <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $content)
                                <tr>
                                    <th>{{ $content->id }}</th>
                                    <td>{{ \Str::limit($content->title, 100) }}</td>
                                    <td>{{ \Str::limit($content->body, 250) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
-->    
           
           
 
           
           
           <!--
            <div class="col-md-8">

            <form action="{{ action('Admin\KijiController@index') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                <div style="margin-bottom:4rem;"></div>
                <ul class ="grid-top">
            
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li><li>1</li><li>1</li>
                    </ul>
                    
                    
                    </div>
                    <label class="col-md-2" for="title">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label class="col-md-2" for="seireki">西暦</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="seireki" value="{{ old('seireki') }}">
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
                    -->
                    
                    <!--
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    -->
                    
                    <!--
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
            </form>
        </div>
    </div>
</div>
@endsection
-->



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