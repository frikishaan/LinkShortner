@extends('layouts.app')

@section('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <style>
      
    </style>
@endsection

@section('content')
    <div class="container my-2">

        <div class="card p-3">
            <h4>URL Details</h4>
            <p class="float-left">
                <form action="{{ URL::to('u/'. $url->url. '/toggle') }}" method="POST" name="toggle">
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{ $url->id }}"> --}}
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="active"  id="active" {{ ($url->is_active)?'checked' : '' }} onchange="this.form.submit">
                        <label class="custom-control-label" for="active">{{ ($url->is_active)? 'Deactivate':'Activate' }}</label>
                    </div>
                </form>
                <script>
                    document.getElementById('active').addEventListener('click', function(){
                        toggle.submit();
                    })
                </script>
            </p>
            <div class="dropdown-divider mb-3"></div>
            <p><b>Short URL</b> : <a href="{{ URL::to('/'. $url->url) }}" target="_blank">{{ env('APP_URL') }}/{{ $url->url }}</a></p>
            <p><b>Long URL</b> : <a href="{{ $url->long_url }}" target="_blank">{{ $url->long_url }}</a></p>
            <p><b>Title</b> : <span class="text-success">{{ $url->title }}</span></p>
            <p><b>Created at</b>:  {{ \Carbon\Carbon::parse($url->created_at)->format('d-M-Y') }}</p>   
            
            <p>
                <a href="{{ URL::to('u/'. $url->url . '/edit') }}" class="btn btn-primary float-right">Edit</a>
            </p>
        </div>
        <br><br>
        <div class="dropdown-divider my-3"></div>
        <br>
        <div class="my-3">
            @if(count($redirects)>0) 
            <h4 class="mb-3">Clicks <span class="text-dark">({{ count($redirects) }})</span></h4>
                <table class="table table-bordered table-responsive-md shadow-sm">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>IP Address</th>
                            <th>Device</th>
                            <th>Platform</th>
                            <th>Browser</th>
                            <th>Clicked At</th>
                        </tr>
                    </thead>

                    @for ($i = 0; $i < count($redirects); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $redirects[$i]['ip'] }}</td>
                                                       
                            <td>
                                @if ($redirects[$i]['device'] == 1)
                                 <i class="fas fa-mobile-alt"></i> 
                                @elseif($redirects[$i]['device'] === 2)
                                    <i class="fas fa-tablet-alt"></i> 
                                @else
                                    <i class="fas fa-desktop"></i> 
                                @endif                            
                            </td>

                            <td>
                                @if ($redirects[$i]['platform'] === 'Windows')
                                    <i class="fab fa-windows"></i> 
                                @elseif($redirects[$i]['platform'] === 'AndroidOS')
                                    <i class="fab fa-android"></i> 
                                @elseif($redirects[$i]['platform'] === 'iOS')
                                    <i class="fab fa-apple"></i> 
                                @elseif($redirects[$i]['platform'] === 'Linux')
                                    <i class="fab fa-linux"></i> 
                                @else 
                                    {{ $redirects[$i]['platform'] }}
                                @endif
                            </td>
                            
                            <td>
                                 @if ($redirects[$i]['browser'] === 'Chrome')
                                    <i class="fab fa-chrome"></i> 
                                @elseif($redirects[$i]['browser'] === 'Safari')
                                    <i class="fab fa-safari"></i> 
                                @elseif($redirects[$i]['browser'] === 'Edge')
                                    <i class="fab fa-edge"></i> 
                                @elseif($redirects[$i]['browser'] === 'FireFox')
                                    <i class="fab fa-firefox"></i> 
                                @else 
                                    {{ $redirects[$i]['platform'] }}
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($redirects[$i]['redirected_at'])->format('d/m/Y') }} </td>
                        </tr>
                    @endfor

                </table>
            @else 
                <h3>No redirects yet.</h3>
            @endif
        </div>
    </div>
    
    {{-- Graphical representaion --}}
    <div class="container mt-4 mb-3 card shadow-sm">
        <br><br>
        <h3 class="text-center"><i class="fas fa-chart-line"></i>&nbsp; Insights</h3>
        <br><br>
        @if(count($url->redirects)>2)
            <div class="row">
                <div class="col-sm-12 col-md-4 card p-2 border-0 m-sm-3 m-lg-0">
                    <canvas id="devices"></canvas>
                    <h5 class="text-center">Clicks by Devices</h5>
                </div><br><br>
                <div class="col-sm-12 col-md-4 card p-2 border-0 m-sm-3 m-lg-0">
                    <canvas id="browsers"></canvas>
                    <h5 class="text-center">Clicks by Browsers</h5>
                </div>
                <div class="col-sm-12 col-md-4 card p-2 border-0 m-sm-3 m-lg-0">
                    <canvas id="platforms"></canvas>
                    <h5 class="text-center">Clicks by Platforms</h5>
                </div>
            </div>
        @else 
            <h5 class="text-center">Not enough data to show.</h5>
        @endif
    </div>

    <script>const id = '{{ $url->id }}';</script>

    @if(count($url->redirects)>2)
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
        <script src="{{ URL::to('/js/charts.js') }}"></script>
    @else 
    @endif
@endsection