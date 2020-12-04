<div class="form-group ">
    <input type="text" name="name" placeholder="@lang('auth.namePlaceholder')" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group ">
    <input type="email" name="email" placeholder="@lang('auth.emailPlaceholder')" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group row">
    <div class="col-6">
        <input type="password" name="password" placeholder="@lang('auth.passwordPlaceholder')" class="form-control  @error('password') is-invalid @enderror">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-6">
        <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('auth.confirmationPlaceholder')">
    </div>
</div>
