<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{env('APP_NAME')}}</title>
    {{-- Style --}}
    @include('partials.style')
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <!-- <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                            Admin Panel
                        </div>

                        <div class="card card-primary">
                            <div class="card-header justify-content-between">
                                <h4>Sign In</h4>
                                <a href="/">Halaman Utama</a>
                            </div>

                            <div class="card-body">
                                @include('errors.flashdata')
                                <form method="POST" action="{{ route('be.auth.do-login') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus value="{{ old('username') }}">
                                        <div class="invalid-feedback">
                                            Username is invalid
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <div class="input-group" id="show_hide_password">
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required value="{{ old('password') }}">
                                            <div class="input-group-append">
                                                <a href="javascript:;" class="input-group-text" style="text-decoration: none;"><i class="fas fa-eye-slash"></i></a>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Password is invalid
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember_me') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember-me">Ingat Saya!</label>
                                            <div class="float-right">
                                                <!-- <a href="javascript:;" class="text-small" data-toggle="modal" data-target="#forgotPassword">Lupa Password?</a> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Sign In
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; {{env('APP_NAME'). ' ' .date('Y')}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="forgotPassword">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="#" method="post" class="needs-validation" novalidate="">
                    <div class="modal-body">
                        <p>Masukkan email kamu yang terdaftar untuk menerima link reset password.</p>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="input-group transparent-append col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                                <div class="input-group-append show-pass">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback">
                                    Harap masukkan email anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- Scripts --}}
    @include('partials.script')
</body>
</html>