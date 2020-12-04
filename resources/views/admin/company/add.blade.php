@extends('adminlte::page')

@section('title', 'Создание компании')

@section('content_header')
    <h1>Создание компании</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('errorMessage')

    {{ Form::open([
        'route'=>['company.store'],
        'method'=>'post',
        ])
    }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание компании</h3>
        </div>
        <div class="card-body">

            <div class="form-group row">

                <div class="form-group col-12">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Введите название компании" value="{{ old('title') }}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @foreach($fields as $key => $field)
                    <div class="form-group col-4">
                        <input type="number" name="{{$key}}" class="form-control" placeholder="{{$field}}" value="{{ old($key) }}">
                     </div>
                @endforeach
                <div class="form-group col-12">
                    <label>Выберите категорию для компании</label>
                    {!! Form::select('category', $categories, null,['class' => 'form-control']); !!}
                </div>

            </div>

        </div>
    </div>

    <a href="{{route('company.index')}}" class="btn btn-secondary">Назад</a>
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

