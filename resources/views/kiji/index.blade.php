
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
                <form action="{{ action('KijiController@index') }}" method="get">
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
                               <a href="kiji/show/{{ $content->id }}">
                               <img src="{{ asset('storage/image/' . $content->image_path) }}" class="mainpageimage">
                               </a>
                               <p>{{ $content->title }}</p>
                               <i class="fab fa-angellist"></i>
                               
                           </div>
                       </li>
                       
                       
                       
                       
                    @endforeach
                    </ul>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>    
  @endsection          
            
           
           
 
           
  