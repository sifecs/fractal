@extends('pages.leyOut')

@section('content')
    <div class="container">
        <div class="shadow p-3 mb-5 bg-white rounded mt-4">
            <div class="mb-3"> Регистрация </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                @include('pages.inc.registerFields')

                <div class="form-group ">
                    <button type="submit" class="form-control btn-primary"> Зарегистрироваться </button>
                </div>

                <div class="form-group ">
                    <a href="{{route('login')}}" class="form-control btn-primary text-center"> Или войдите </a>
                </div>
            </form>
        </div>
    </div>
@endsection


{{--@extends('adminlte::auth.register')--}}
