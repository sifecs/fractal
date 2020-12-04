@extends('pages.leyOut')

@section('content')
    <div class="container">
        {{ Form::open([
            'route'=>['profile.update'],
            'method'=>'put',
            ])
        }}

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Редактирование аккаунта</h3>
            </div>
            <div class="card-body">

                <div class="form-group row">

                    <div class="form-group col-6">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Введите имя" value="{{ $user->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Введите email" value="{{$user->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" placeholder="Введите пароль" value="">
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

                    <div class="form-group col-12">
                        <label>Выберите страну для пользователя</label>
                        {!! Form::select('country_id', $countries, $user->country_id, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <input type="submit" value="Сохранить" class="btn btn-success float-right">
                {{Form::close()}}
            </div>
        </div>

    @if(!$categories->isEmpty())
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название компании </th>
                <th scope="col">Рейтинг</th>
                <th scope="col">редактировать</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $company)
                <tr>
                    <th scope="row">{{$company->id}}</th>
                    <td>{{$company->title}}</td>
                    <td>{{$company->rating}}</td>
                    <td>
{{--                        <span class="ml-3">--}}
{{--                            <a href="{{route('categoryFront.edit', $company->id)}}"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </a>--}}
{{--                        </span>--}}
{{--                        <span>--}}
{{--                            {{Form::open(['route'=>['companyFront.destroy', $company->id], 'method'=>'delete', 'class' => 'd-inline-block'])}}--}}
{{--                            <button type="submit" class="delete btn p-0">--}}
{{--                                <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                            </button>--}}
{{--                            {{Form::close()}}--}}
{{--                        </span>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
