@extends('layouts.admin')
@section('title','【編集】年表・地図つきメモ帳 ~ 観光や歴史の勉強向き ~')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>詳細ページ</h2>
            <form action="{{ action('Admin\KijiController@update', ["id" => $content_form->id]) }}" method="get" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                 
                <div class="form-group row">
                 <label class="col-md-2" for="title">画像</label>
                    <div class="col-md-4">
                        <img src="{{ asset('storage/image/' . $content_form->image_path) }}">
                           
                            
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
                        <p style="font-size:3rem;">{{ $content_form->title }}</p>
                    </div>
                 </div>
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="title">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ $content_form->title }}">
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
                    
                    
                    @if($content_form->user_id === Auth::id())
                    <div class="form-group row">
                        <div class="col-md-10">
                            <a href={{ action('Admin\KijiController@edit' ,['id'=> $content_form->id] ) }}>
                                <input type="button" class="btn btn-primary" value="編集する">
                            </a>
                        </div>
                    </div>
                    @endif
            </form>   
            
            
            @auth           
            <div style="margin-bottom:10rem;"></div>           
            <form action="{{ action('KijiController@toukou') }}" method="post" enctype="multipart/form-data">    
                <div class="form-group row">
                    <label class="col-md-2" for="toukou">コメントする</label>
                    <div class="col-md-10">
                        <div class="col-md-10">
                            {{ csrf_field() }}
                            <textarea required class="form-control" name="toukou" rows="5">{{ old('toukou') }}</textarea>
                            <input type="hidden" value={{ $content_form->id }} name="content_id" >
                        </div>
                    </div>
                    
                <div style="margin-bottom:10rem;"></div>
                        
                <div class="col-md-10">
                    
                        <input type="submit" class="btn btn-primary" value="投稿">
                    
                </div>
            </form>   
                
                    </div>
                                       
                     </div>
                        </div>
                @endauth
                    
                    

                    <div id="comment" class="row mt-5">
                        <div class="col-md-4 mx-auto">
                             <h2>コメント欄</h2>
                                <ul class="list-group">
                                 @if ($content_form->questions != NULL)
                                 {!! $comments = $content_form->questions()->orderBy('id','desc')->paginate(10); !!}
                                 
                                    @foreach ($comments as $question)
                                        <li class="list-group-item">{{ $question->toukou }}</li>
                                    @endforeach
                                 @endif
                                 <div style="margin-bottom:1rem;"></div>
                                 </ul>
                        </div>
                    </div>
                    
                
                    
                    <div class="row mt-5">
                        <div class="col-md-4 mx-auto">
                             <h2>編集履歴</h2>
                                <ul class="list-group">
                                 @if ($content_form->histories != NULL)
                                @foreach ($content_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                                </ul>
                        </div>
                    </div>
                    
                    
                    
                    
<div class="container">
  <button class="button" data-modal-open="modal-1">
    OPEN
  </button>
  
  <div class="modal" id="modal-1">
    <div class="modal-overlay" data-modal-close>
      <div class="modal-container">
        <h2 class="modal-title">モーダルウィンドウ</h2>
        <div class="modal-content">
          <p>モーダルウィンドウ（英: modal window）は、コンピュータアプリケーションソフトウェアのユーザインタフェース設計において、何らかのウィンドウの子ウィンドウとして生成されるサブ要素のうち、ユーザーがそれに対して適切に応答しない限り、制御を親ウィンドウに戻さないもの。</p>
        </div>
        <div class="modal-footer">
          <button class="button" data-modal-close="modal-1">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

                
                

                
                
                
              </div>
        </div>
    </div>
@endsection