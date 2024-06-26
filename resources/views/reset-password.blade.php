@extends('layout.common-layout')

@section('resetPasswordForm')

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">OES</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Online Examination System</h5>
                        </div>

                        <form action="{{ route('resetPassword') }}" method="POST" class="row g-3 needs-validation"
                            novalidate>
                            @csrf

                            <div class="col-12">
                                <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="yourPassword" required>
                                <div class="invalid-feedback">Please enter your confirm password!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                            </div>
                        </form>

                        @if (Session::has('success'))

                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ Session::get('success') }} <a href="/login">please Log in</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection