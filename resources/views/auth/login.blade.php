@extends('pages.leyOut')

@section('content')
    <div class="container">
        <div class="shadow p-3 mb-5 bg-white rounded mt-4">
            <div class="mb-3"> Вход </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @include('pages.inc.loginFields')

                <div class="form-group ">
                    <button type="submit" class="form-control btn-primary"> Войти </button>
                </div>

                <div class="form-group ">
                    <a href="{{route('register')}}" class="form-control btn-primary text-center"> Или зарегистрироваться </a>
                </div>
            </form>
            <p class="my-0">
                <a href="{{route('password.update')}}">
                    Восстановление пароля
                </a>
            </p>
        </div>
    </div>
@endsection


{{--@extends('adminlte::auth.login')--}}
