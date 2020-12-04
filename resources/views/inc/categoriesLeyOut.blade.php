@if(isset($attr))
    @php
        $forimplode = [];
        foreach ($attr ?? [] as $key => $value) {
                $forimplode[] = "{$key}='{$value}'";
            }
            $imploded = implode(" ", $forimplode);
    @endphp
@endif

@if(isset($valueAttr))
    @php
        $leyOut = [];
        foreach ($valueAttr ?? [] as $key => $value) {
                $leyOut[] = "{$key}='{$value}'";
            }
            $valueAttrLeyOut = implode(" ", $leyOut);
    @endphp
@endif


@isset($wrap)
    {!! str_replace('>', isset($imploded) ? " {$imploded} >" : '>', $wrap) !!}
@endisset

@foreach($cats as $cat)
    @isset($valueWrap)
        {!! str_replace('>', isset($valueAttrLeyOut) ? " {$valueAttrLeyOut} >" : '>', $valueWrap) !!}
    @endisset

        {{$cat->getTranslation('name','ru')}}

        @if (!$cat->children->isEmpty())
            @isset($wrap)
                {!! $wrap !!}
            @endisset
                @include('inc.categoriesLeyOut', ['cats' => $cat->children])
            @isset($wrap)
                {!!str_replace('<', '</' , $wrap) !!}
            @endisset
        @endif

    @isset($valueWrap)
        {!!str_replace('<', '</' , $valueWrap) !!}
    @endisset

@endforeach

@isset($wrap)
    {!!str_replace('<', '</' , $wrap) !!}
@endisset
