@extends('pages.leyOut')

@section('content')

    @include('pages.inc.categoryBreadCrumbs')

    <div class="container">
        <div class="shadow p-3 mb-5 bg-white rounded">
            @lang('main.TheCost',['price' => $category->price])
        </div>

        <div>@lang('main.needToGo')</div>

        <div class="shadow p-3 mb-5 bg-white rounded mt-4">
            @if(!Auth::check())
                <div class="d-flex">
                    <button id="headingOne" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">@lang('auth.register') </button>
                    <button id="headingTwo" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo">@lang('auth.login')</button>
                </div>

                <div id="accordion">
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                @include('pages.inc.registerFields')
                                <div class="form-group ">
                                    <button type="submit" class="form-control btn-primary"> @lang('auth.registerButton') </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                @include('pages.inc.loginFields')
                                <div class="form-group ">
                                    <button type="submit" class="form-control btn-primary"> @lang('auth.loginButton') </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div>@lang('auth.registerCompleted')</div>
            @endif
        </div>

        <div class="shadow p-3 mb-5 bg-white rounded mb-5">
            @if(!Auth::check())
            <div>@lang('main.Payment')</div>
            @else
                <div>
                    @lang('main.Payment')
                    <button type="submit" class="form-control btn-primary"> @lang('main.Pay', ['price' => $category->price]) </button>
                </div>
            @endif
        </div>

    </div>
@endsection
