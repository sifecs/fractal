@extends('pages.leyOut')

@section('content')
    <div class="container">
        <div class="shadow p-3 mb-5 bg-white rounded mt-4">
            <div class="mb-3"> Восстановление пароля </div>
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{route('password.email')}}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="@lang('auth.emailPlaceholder')" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-block btn-primary">
                    <span class="fas fa-share-square"></span>
                    Отправить ссылку для восстановления пароля
                </button>
            </form>
        </div>
    </div>
@endsection

{{--@extends('adminlte::auth.passwords.email')--}}
