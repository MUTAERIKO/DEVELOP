
@extends('layouts.admin')
@section('title','プロフィール画面')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>プロフィール</h2>
            <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2" for="pro_id">ID</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="pro_id" value="{{ old('pro_id') }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2" for="pro_name">名前</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="pro_name" value="{{ old('pro_name') }}">
                    </div>
                </div>
                
            
                <div class="form-group row">
                    <label class="col-md-2" for="pro_come">プロフィール</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="pro_come" rows="15">{{ old('pro_come') }}</textarea>
                        </div>
                </div>
                    
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="作成">
            </form>
        </div>
    </div>
</div>
@endsection
