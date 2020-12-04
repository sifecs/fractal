@extends('pages.leyOut')

@section('content')
    <div class="container">
        @if(\Auth::user()->hasVerifiedEmail())

            @include('errorMessage')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование компании</h3>
                </div>
                <div class="card-body">
                    {{ Form::open([
                            'route'=>['categoryFront.update', $company->id],
                            'method'=>'put',
                        ])
                    }}
                    <div class="form-group mb-4 row">

                        <div class="form-group col-12">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Введите  название компании" value="{{ $company->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        @foreach($fields as $key => $field)
                            <div class="form-group col-4">
                                <input type="number" name="{{$key}}" class="form-control" placeholder="{{$field}}" value="{{ $company->$key }}">
                            </div>
                        @endforeach

                        <div class="form-group col-12">
                            <label>Выберите категорию для компании</label>
                            {!! Form::select('category', $categories, $company->categories->pluck('id')->all() ,['class' => 'form-control']); !!}
                        </div>

                    </div>
                    <input type="submit" value="Сохранить" class="btn btn-success float-right">
                    {{Form::close()}}
                </div>
            </div>
        @else
            <div>Для доступа к этой странице вам нужно подтвердить почту</div>
        @endif

    </div>
@endsection
