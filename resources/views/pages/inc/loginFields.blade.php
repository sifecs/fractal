<div class="form-group">
    <input type="email" name="email" placeholder="@lang('auth.emailPlaceholder')" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <input type="password" name="password" placeholder="@lang('auth.passwordPlaceholder')" class="form-control  @error('password') is-invalid @enderror">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="icheck-primary">
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">@lang('auth.remember')</label>
</div>

