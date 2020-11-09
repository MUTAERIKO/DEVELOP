
@extends('layouts.admin')
@section('title','【編集】年表・地図つきメモ帳 ~ 観光や歴史の勉強向き ~')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>【編集画面】コンテンツ</h2>
            <form action="{{ action('Admin\KijiController@update') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                 
               <div class="form-group row">
                 <label class="col-md-2" for="title">画像</label>
                    <div class="col-md-10">
                        <img src="{{ asset('storage/image/' . $content_form->image_path) }}">
                            <div style="margin-bottom:2rem;"></div>
                                 <input type="file" class="form-control-file" name="image" value="{{ old('image_path', $content_form->image_path) }}">
                            <div class="form-text text-info">
                                設定中: {{ $content_form['image_path'] }}
                            </div>
                            
                           <!--
                           <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                            -->
                    </div>
                 </div>
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="title">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ old('title' , $content_form->title) }}">
                    </div>
                 </div>
                 
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="seireki">西暦</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="seireki" value="{{ $content_form->seireki }}">
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">記事本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="15">{{ $content_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="googlemap">Googlemap</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="Googlemap" rows="5">{{ $content_form->googlemap }}</textarea>
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
                    
                                        
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $content_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    
                        <div class="col-md-1">
                            <a href="{{ action('Admin\KijiController@delete', ['id' => $content_form->id]) }}">
                            <input type="submit" class="btn btn-primary" value="削除"></a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection