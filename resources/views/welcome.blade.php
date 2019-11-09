@extends('layouts.app')

@section('styles')
    <style>
        .f{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        #features h3{
            font-weight: 700;
        }
        #features .row p{
            color: grey;
            text-align: center;
        }
        #brands i.fab{
            font-size: 220px !important;
        }
        @media screen and (max-width:767px){
            .f{
              margin-bottom: 2rem;  
            }
            #features .col-sm-12{
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 f mb-sm-3">
                <h2>Powerful, Recognizable Links</h2>
                <p>Pick a plan, secure a free custom domain and start sharing branded links.</p>
                <a href="{{ URL::to('register') }}" class="btn btn-outline-primary w-50">Get Started for free</a>
            </div>
            <div class="col-sm-12 col-md-6 mt-sm-3">
                <img src="{{ URL::to('/images/status.svg') }}" alt="" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>

<div id="features" class="container my-4" style="margin:4rem auto !important;">
        <h3 class="text-center">Grow Your Brand With Every Click</h3>
        <p  class="text-center">Branded links can drive a 34% higher click-through versus non-branded links, meaning they help get more eyeballs on your brand and its content.</p>

    <br/><br/>
        <div class="row my-4">
            <div class="col-sm-12 col-md-4">
                <div class="card p-3">
                    <img src="{{ URL::to('images/dashboard.svg') }}" height="200px" width="100%" alt="">
                <br><br>
                <h4 class="text-center">Personalized Dashboard</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi, tempore dolor puttu. lorem</p>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-4">
                <div class="card p-3">
                    <img src="{{ URL::to('images/finance.svg') }}" height="200px" width="100%" alt="">
                <br><br>
                <h4 class="text-center">Grow your CTR</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit dolor porro dolorem!</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
               <div class="card p-3">
                    <img src="{{ URL::to('images/social.svg') }}" height="200px" width="100%" alt="">
                <br><br>
                <h4 class="text-center">Sharable links</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eos quas aliquid exercitationem.</p>
               </div>
            </div>
        </div>
</div>
<br>
<div id="brands" class="text-center my-4">
    <h3><b>Loved by the most recognized brands in the world</b></h3>
    <br/>
    <i class="fab fa-facebook fa-2x mr-3"></i>
    <i class="fab fa-reddit-alien fa-3x mr-4"></i>
    <i class="fab fa-aws fa-3x mr-4"></i>
    <i class="fab fa-alipay fa-3x mr-4"></i>
    <i class="fab fa-500px fa-3x mr-4"></i>
    <i class="fab fa-fedex fa-3x mr-4"></i>
    <i class="fab fa-patreon fa-3x mr-4"></i>
</div>

<br/><br/>
<div id="last" style="background-color: #eee;" class="py-4 text-center">
    <h3>Take your links to the next level</h3><br>
    <a href="{{ URL::to('register') }}" class="btn btn-primary btn-lg">Get started for free</a>
    <br>
    <br>
</div>

@endsection