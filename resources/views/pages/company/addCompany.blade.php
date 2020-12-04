@extends('pages.leyOut')

@section('content')
    @include('pages.inc.categoryBreadCrumbs')

    <div class="container">
        {{ Form::open([
            'route'=>['categoryFront.store'],
            'method'=>'post',
            ])
        }}

            <div class="form-group row">
                <input type="hidden" name="category_id" value="{{$category->id}}">
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
                <input type="submit" value="Сохранить" class="btn btn-success float-right">
            </div>

        {{Form::close()}}

        @if(!$userCompanies->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название компании>
                        <th scope="col">Рейтинг</th>
                        <th scope="col">редактировать</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userCompanies as $company)
                    <tr>
                        <th scope="row">{{$company->id}}</th>
                        <td>{{$company->title}}</td>
                        <td>{{$company->rating}}</td>
                        <td>
{{--                            <span class="ml-3">--}}
{{--                                <a href="{{route('categoryFront.edit', $company->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>--}}
{{--                            </span>--}}
{{--                            <span>--}}
{{--                                {{Form::open(['route'=>['companyFront.destroy', $company->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}--}}
{{--                                <button type="submit" class="delete btn p-0">--}}
{{--                                    <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                                </button>--}}
{{--                                {{Form::close()}}--}}
{{--                            </span>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
