@extends('adminlte::page')

@section('title', 'Редактирование языка перевода')

@section('content_header')
    <h1>Редактирование языка перевода</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['locale.update', $locale->id],
        'method'=>'put',
        ])
    }}
    <div class="card card-primary">
        <div class="card-body">

            <div class="form-group">
                <label class="text-danger">обезательное поле</label>
                <input type="text" name="name" class="form-control disabled @error('name') is-invalid @enderror" placeholder="Введите название язык перевода" value="{{$locale->name }}">
                <small class="form-text text-muted">Пример ru, en </small>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="checkbox" name="status" value="1" @if($locale->status) checked @endIf
                       data-bootstrap-switch data-off-color="danger" data-on-color="success" class="form-control">
            </div>

        </div>
    </div>

    <a href="{{route('locale.index')}}" class="btn btn-secondary">Назад</a>
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
