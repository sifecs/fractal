@extends('adminlte::page')

@section('title', 'Редактирование пользователя')

@section('content_header')
    <h1>Редактирование старны</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['country.update', $country->id],
        'method'=>'put',
        ])
    }}

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование старны</h3>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <div class="form-group col-6">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите имя" value="{{ $country->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

        </div>
    </div>

    <a href="{{route('country.index')}}" class="btn btn-secondary">Назад</a>
    <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}

@endsection

@section('js')

@stop
