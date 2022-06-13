@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-2 pb-2 rounded" style="background-color: rgba(240, 240, 240, 0.8);">
            <div class="card" style="background-color: rgba(169, 226, 238, 1);">
                <div class="card-header bg-primary text-white text-center">
                    <h1>Registrarse</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" style="background-color: rgba(255, 255, 255, .7);" class="py-4 px-4 rounded">
                        @csrf

                        <div class="form-group row mb-3 align-items-center">
                            <div class="col-4">
                                <label for="image" class="col-md-12 col-form-label text-md-end">Imagen</label>

                                <div class="col-md-12">
                                    <input type="hidden" name="imagePreview" id="imagePreview" value="{{ old('imagePreview') }}" ref="imagePreview">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror text-md-end" name="image" value="{{ old('image') }}" autocomplete="image" @change="onFileChange($event, 'image_preview', 'imagePreview')" {{ old('image') ? '' : 'required' }}>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-md-12 text-md-center" style="height: 125px;">
                                    @if (old('imagePreview'))
                                        <img :src="'{{ old('imagePreview') }}'" class="img-thumbnail rounded-circle" style="width: auto; height: 100%;" ref="image_preview">
                                    @else
                                        <img :src="'https://ekokompassi.fi/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-e1548313896464.png'" class="img-thumbnail rounded-circle" style="width: auto; height: 100%;" ref="image_preview">
                                    @endif
                                </div>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Usuario -->
                        <div class="row mb-3">
                            <label for="usuario" class="col-md-4 col-form-label text-md-end">Usuario</label>

                            <div class="col-md-6">
                                <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario">

                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection