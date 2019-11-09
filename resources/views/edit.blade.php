@extends('layouts.app')

@section('styles')
    
@endsection

@section('content')

<div class="container">
    <div class="card shadow-sm p-4">
        <h2 class="text-center">URL Shortner</h2>
    <br>
    @if ($errors->has('alias'))
        {{$errors->first('alias')}}
    @endif
    <form action="{{ URL::to('u/' . $url->url . '/edit') }}" method="POST">
        @csrf
        Custom alias (optional): <br>
        <div class="input-group mb-3 mt-1">
            <div class="input-group-prepend">
                <span class="input-group-text">http://tini.fy/</span>
            </div>
            <input type="text" name="alias" class="form-control" placeholder="MyPage" value="{{ $url->url }}">&nbsp;
        </div>
        <div class="form-group">
            <label for="long_url">Long URL:</label>
            <input type="url" name="url" class="form-control" id="long_url" value="{{ $url->long_url }}">
        </div>
        <div class="form-group">
            <label for="title">Title (optional) :</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $url->title }}">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
        <a href="{{ URL::to('u/'. $url->url ) }}" class="btn btn-default">Cancel</a>
    </form>
    </div>
</div>

@endsection
