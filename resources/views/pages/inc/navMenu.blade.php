<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Fractal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navBar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">@lang('navMenu.main')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('navMenu.about')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('navMenu.roles')</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">

                    <div class="nav-link dropdown-toggle " data-toggle="dropdown"> {{\Auth::user()->country->name ?? session()->get('country', $countries->first())->name}} </div>

                    <div class="dropdown-menu">
                        @foreach($countries as $country)
                            @if((\Auth::user()->country->name ?? session()->get('country', $countries->first())->name) != $country->name)
                                <div data-url="{{route('changeCountryAjax',$country->id )}}" class="dropdown-item changeCountryAjax"> {{$country->name}} </div>
                            @endif
                        @endforeach
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/{{app()->getLocale()}}"  data-toggle="dropdown" >
                        {{app()->getLocale()}}
                    </a>
                    <div class="dropdown-menu">
                        @foreach($locales as $locale)
                            @if(app()->getLocale() != $locale)
                                <a class="dropdown-item" href="/{{$locale}}">{{$locale}}</a>
                            @endif
                        @endforeach
                    </div>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">@lang('navMenu.auth')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">@lang('navMenu.register')</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                @lang('navMenu.logAut')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
