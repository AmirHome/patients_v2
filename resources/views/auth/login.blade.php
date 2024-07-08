
@extends('layouts.app')
@section('content')

<div class="row d-flex justify-content-center align-items-center full-height bg-white">
<div class="col-md-3 welcome-div justify-content-center align-items-center">
<img src="{{ asset('img/clinics-logo.png') }}" alt="Logo Image" class="dashboard-img img-fluid">
   <h1 class="welcome-text"> Hi, Welcome back</h1><br>
   <h6 class="welcome-under-text">More effectively with optimized workflows.</h6><br><br>
   <img src="{{ asset('img/dashboard.webp') }}" alt="dashboard Image" class="dashboard-hero-img img-fluid"><br><br>
<div class="login-alt-img">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD2ElEQVR4nM3X4U8TdxgH8KcYDEEWXgjyRmN6d/WqWXxlsmR/wjDqGxNfbMmS7a1x2d4Y46Lim2kF2rKqvLG8WGKEGbFlVGGMidmkzKmJ0yWzttBSyvXgAMtVoMCz/Ho9er27wt0xwp7k+6aXNJ/8+v09bQEMzLQP/sBb8An8H2bSAyL64SVegIpthWSuw55kKyB2AKIfTmwrhvfBp0l3AdMBzxHBtm2YtBduKDAkx7YNM+mG30owfnimPB3OA4PT30MC26FyyzFJNyRVJ0NAjeTZjBfssWuAwvX8619uOSbeDIsaTAc8JafDeaAv6lrDjGIn7NR7Dy7kCGR+Zc5sCpJsh+qYC1AHgzk/nBhrhmUFhpzYF1oIPRztpnF5mH22KYzgg8ZoGczCzYoh8kyFiSq7w/UyvxNIoodBDLMi4ib2VLoNrupi/LAoNu2OJ1tscyUYxenIEBLuIYM44kT88xBjGcN5oF8Ps3yj8pF4oQHnvqt5q8F0wCgXop/IEJLZXxwSZvig9aU54YaYBuOH+WxTHUcwJOOttndKjBDYu4aQk318QMKE2fOWMfEWENWYZd/OQRlCMnul5u2MrwAJ7tNApPI6ZcxtSxBEqIi5YLUE44fZ7KV6QYnJ52bFP0JAHxIPFvoiYV5awkz74GP5tsiYJW9VyanImbpnn9eDSOV1KDFL+Nch3V207kx54XwJxg+ceKl+Xg1Jd1Gr5SAkMwOFvhTzoWkM1wbdSsyipzp/g5Thu6iV9SBSeVk15pRpTMoNf69hWmBx/mL9ggqS2whS2LxqzGXTmPEWyC80kkRTVboE8iO1ZAQSD9JqCOIIe880ZrQZVghkrNmWi3xTt1qE2BeMQEgmHyhuUrHEb0xBeC845VOJfluTiXxdL0HuUlmjEKm8Dh2McwVfHN5lGDPlg9MEEr9mW3j1VR0SzNRdKmMGQiIOaW6SfDpHDGPSbfADwUTOfSC+OlOHqTt2Qx3RlPcJWw7zuWFMyg3PEy5blkAmLELGAjp9KX5ULsOY8VbgI2dr36c6qfdWIPnyhnT6UkzIMCZxZQeX6qJEqxASQbt5lUkYgmTc0MB122c2A5HKW6Yvcp5StRtiyI9q7qEjGOum1/3O2Si5suV1RjDsPApmRvj5wOFUiHkdvW+lvHqb15nFMHsRB/dXgdXhB+jPEj20qR2TCqlvEhvEEQcF/8VgJ+zg+5j20QC9Yqy8azcpgWH2JGzFCAMH96dCzIvYBpjMI0cOR5weU2vf6vD99PHxn2hBDzLRy/DikOOjLUdoUH2MN95Di7H75I8aneH7GPO/VRTzL/0tQ6ALvcKaAAAAAElFTkSuQmCC">


<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAACXBIWXMAAAsTAAALEwEAmpwYAAACV0lEQVR4nL2XTUhVURSFP9DsVYJFRdEP9EcJ0TwaREEFKkIYVBBoWATZoIGQIAQ1adREHDcpiqjABEss+6FIi0QjclYjcRIEqf36MOPCfvA4nHPu3r7rW7AH8s5ad13vPvusA2GMA/PKemBY+xYjdhjE/wDrgZ/K9f+ATRYzlwxmHgnnoYFzwWLmjUH4rHBaDJxBrZF1wJxSdE4+UYKVwKySlwfWaMycM7zhS4f71MBt1ph5bBC86HDbDNyeNCPVwG+D4FaHv8HwiX8BK2JmThiMvA9oDBs0mmJm7hiEOjMYC7dCRiqBUeBLpD4AI1K1AZ3tRWvc+uzojQFLfCL7gF5gNeXBWtkse2P/3glg/yIbOQBMyvPa0/olD1wGKjI2kehddXact28GPQ32AtiYkZFksj/xPKPft3gk0PFfgfoSjdSJjk//nY/wKuXY7wKqjCaSHXolZRA+8xF7sjxtBX0KzXt4cF1BvI0NNxSa13zEJgXxmNFMo0KzITSE8ikHW7XRTA6YiWj+BVaFyLHo2Bt5aHIEhHA/onk39ib1EeJpz/qlQLfstm7528WpiOZBUvBcGRO3eOLCqNwsilEjn8PVHECBPZ4s686Ck8BU4G2nJBcVY8BZkwS4nSjRGrha5GT4zSvqJrBceOed385gRJdz6Uryy0elkUIl+WeXE0e9c0WDDumL5pQtGqsZaeIhORpKQiPwY4FGCjUNHCYj1EpEXIiRT8BuMkbO0LzFTbyMRcRR4FuKie/AccqEzcDrSFjaRplR6QSnQgDzXj3KhUMyT46UqvQfNmEn03vIZMMAAAAASUVORK5CYII=">

        
</div>
    </div>
<div class="col-md-3">
</div>
    <div class="col-md-3">
        <div class="card mx-4">
            <div class="card-body p-4 login-card-body">
                <h3 class="sign-text">Sign in to your account</h3>     
              <div> <span class="sign-under-text"> Don't have an account? </span>
                 <a class="btn btn-link px-0" href="{{ route('register') }}" style="color:#00A76F;font-weight:600;">
                                {{ trans('global.getStarted') }}
                            </a></div>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <br>
                <div class="login-info-div">
                <svg class="info-icon" focusable="false" aria-hidden="true" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"></path></svg>
                <span class="login-info">Use <strong>admin@admin.com</strong> with password  <strong> admin@123 </strong></span>

                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 text-right" >
                            @if(Route::has('password.request'))
                                <a class="btn btn-link px-0" style="color: #000;font-weight:400;" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a><br>
                            @endif
                       
                        </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                  

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-light px-4 pt-2 pb-2 btn-block">
                                {{ trans('global.login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
</div>
</div>
@endsection