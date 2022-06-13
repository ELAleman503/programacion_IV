<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="antialiased" style="background-image: url('https://vpnparadise.com/wp-content/uploads/2020/07/racism.png'); background-size: cover; background-repeat: no-repeat; background-position: top;">
        <div class="container-fluid">
            @if (Route::has('login'))
                <div class="row">
                    <div class="col-md-4 offset-md-4 text-center text-md-center mt-5 mb-5 pt-2 pb-2 rounded" style="background-color: rgba(240, 240, 240, 0.8);">
                        <div class="card" style="background-color: rgba(169, 226, 238, 1);">
                            <div class="card-header bg-primary text-white text-center">
                                <h1 class="card-title">{{ config('app.name', 'Laravel') }}</h1>
                            </div>
                            <div class="card-body">
                                <div class="alert" role="alert">
                                    <div class="form-group row mb-2 text-center">
                                        <div class="col-md-12">
                                            <a href="{{ route('login') }}" class="btn btn-primary m-2 fs-2 px-5">{{ __('Login') }}</a>
                                        </div>
                                    </div>
                                    @if (Route::has('register'))
                                    <div class="form-group row mb-2 text-center">
                                        <div class="col-md-12">
                                            <a href="{{ route('register') }}" class="btn btn-primary m-2 fs-2 px-5">{{ __('Register') }}</a>
                                        </div>
                                    </div>
                                    @endif
                    
                                </d>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>
