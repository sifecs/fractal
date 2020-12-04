@extends('adminlte::page')

@section('title', 'Создание новой страны')

@section('content_header')
    <h1>Создание новой страны</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['country.store'],
        'method'=>'post',
        ])
    }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание страны</h3>
        </div>
        <div class="card-body">
            <div class="form-group ">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите название страны" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <a href="{{route('country.index')}}" class="btn btn-secondary">Назад</a>
    <input type="submit" value="Сохранить" class="btn btn-success float-right">
    {{Form::close()}}

@endsection

@section('js')

@stop
