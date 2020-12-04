@extends('pages.leyOut')

@section('content')
    <div class="container">
        <div class="shadow p-3 mb-5 bg-white rounded mt-4">
            <div class="mb-3"> Восстановление пароля </div>
            <form method="POST" action="{{ route('password.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group ">
                    <input type="email" name="email" placeholder="@lang('auth.emailPlaceholder')" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <input type="password" name="password" placeholder="@lang('auth.passwordPlaceholder')" class="form-control  @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('auth.confirmationPlaceholder')">
                    </div>
                </div>

                <div class="form-group ">
                    <button type="submit" class="form-control btn-primary"> Востановить пароль </button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{--@extends('adminlte::auth.passwords.reset')--}}
