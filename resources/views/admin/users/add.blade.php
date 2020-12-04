@extends('adminlte::page')

@section('title', 'Создание нового пользователя')

@section('content_header')
    <h1>Создание нового пользователя</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['users.store'],
        'method'=>'post',
        ])
    }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Регистрация пользователя</h3>
        </div>
        <div class="card-body">

            <div class="form-group row">

                <div class="form-group col-6">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите имя" value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Введите email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Введите пароль" value="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Введите пароль" value="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label>Выберите роли для пользователя</label>
                    {!! Form::select('roles[]', $roles, null,['multiple' => true, 'class' => 'form-control']); !!}
                </div>

                <div class="form-group col-6">
                    <label>Предоставить доступ к категориям</label>
                    {!! Form::select('categories[]', $categories, null,['multiple' => true,'class' => 'form-control']); !!}
                </div>

                <div class="form-group col-12">
                    <label>Выберите страну для пользователя</label>
                    {!! Form::select('country_id', $countries, null,['class' => 'form-control']); !!}
                </div>

                <div class="form-group col-12">
                    <span class="mr-3"><strong>статус </strong></span>
                    <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger"  data-on-color="success" class="form-control">
                </div>
            </div>

        </div>
    </div>

    <a href="{{route('users.index')}}" class="btn btn-secondary">Назад</a>
    <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}

@endsection

@section('js')
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@stop

