@extends('pages.leyOut')

@section('content')
    <div class="container">
        <div class="card" style="max-width: 500px; margin: 0 auto;" >
            <div class="card-header">
               Подтвердите почту
            </div>
            <div class="card-body">
                @if(session('resent'))
                    <h6 class="alert alert-success card-title">
                        Письмо с подтверждением отправлено вам на почту
                    </h6>
                @endif
                <h5 class="card-title">
                    Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.
                    Если вы не получили письмо,
                </h5>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                        нажмите здесь, чтобы запросить другой
                    </button>.
                </form>
            </div>
        </div>
    </div>
@endsection



{{--@extends('adminlte::auth.verify')--}}
