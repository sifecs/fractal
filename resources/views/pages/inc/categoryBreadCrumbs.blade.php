<nav>
    <ul>
        <li><a class="text-muted" href="/">@lang('navMenu.main')</a></li>
        @foreach($ancestors as $ancestor)
            <li> <a class="text-muted" href="{{route('category',[$ancestor->slug])}}">{{$ancestor->name}}</a> </li>
        @endforeach
        <li class="font-weight-bold">{{$category->name}}</li>
    </ul>

</nav>
