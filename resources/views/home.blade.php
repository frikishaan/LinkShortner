@extends('layouts.app')

@section('content')
<style>
    table{
        /* table-layout: fixed; */
        width: 100%;
    }
.text-truncate div {
   width: 356px;
   white-space: nowrap;
   overflow: hidden;         
   text-overflow: ellipsis;
 }
</style>
<div class="container my-4">

    <div class="card p-4 shadow-sm">
        <h3 class="text-center mb-3">Shorten a URL</h3>
        <form action="{{ URL::to('shorten-url') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="url">Long URL:</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}" required>
                @if($errors->has('url'))
                    <small class="helper-text text-danger">{{ $errors->first('url') }}</small>
                @endif
            </div>
            
            Custom alias (optional): <br>
            <small class="form-text text-muted">May contain alphabets or digits or '_' or '-' only OR just leave blank and let the system choose.</small>
            <div class="input-group mb-3 mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">http://tini.fy/</span>
                </div>
                <input type="text" name="alias" class="form-control" placeholder="MyPage" value="{{ old('alias') }}">&nbsp;<br>
                @if($errors->has('alias'))
                    <small class="helper-text text-danger">{{ $errors->first('alias') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Shorten</button>
        </form>
    </div>

    <br>
    <hr>
    <h4 class="mt-3">Shortened URLs</h4> 
    <br>
    @if(count($urls)>0)
        <table class="table table-bordered mt-2 p-2 table-responsive-md">
            <thead>
                <tr>
                    {{-- <th>S.no</th> --}}
                    <th>Short URL</th>
                    <th>Long URL</th>
                    <th>Clicks</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
                @foreach ($urls as $url)
                <tr>
                    {{-- <td>{{ $url->id }}</td> --}}
                    <td><a href="{{ URL::to('/'. $url->url) }}" target="_blank">{{ $url->url }}</a></td>
                    <td class="text-truncate w-50"><div><a href="{{ $url->long_url }}" target="_blank">{{ $url->long_url }}</a></div></td>
                    <td>{{ $url->clicks }}</td>
                    <td>
                        @if ($url->is_active)
                            <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-times-circle text-danger"></i>                        
                        @endif
                    </td>
                    <td><a href="{{ URL::to('u/'. $url->url) }}">View/Edit</a></td>
                </tr>
                @endforeach
    
            {{-- {{ $urls }} --}}
        
        </table>
    @else
        <h6 class="text-center">Your shortened URL(s) will be displayed here. </h6>
    @endif
</div>
@endsection
