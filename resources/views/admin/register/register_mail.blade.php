@extends('layouts.admin')
@section('title','メール送信フォーム')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>メール送信フォーム</h2>
            <form action="{{ action('Admin\MailFormController@send') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                
                @if (Session::has('success'))
                <div id="sample">
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif
                
                
                <div class="form-group row">
                    <label class="col-md-2" for="name_form">名前</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name_form" value="{{ old('name_form') }}" >
                    </div>
                 </div>
                 
                 
               
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="email_form">メールアドレス</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="email_form" value="{{ old('email_form') }}">
                    </div>
                 </div>
                 
                 
                 <div class="form-group row">
                    <label class="col-md-2" for="message_form">メッセージ</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="message_form" value="{{ old('message_form') }}">
                    </div>
                    </div>

                    
                    
                    <div class="form-group row">
                        <div class="col-md-10">
                            
                                <input type="submit" class="btn btn-primary" value="送信する">
                           
                        </div>
                    </div>
                    

                
              </div>
        </div>
    </div>
@endsection