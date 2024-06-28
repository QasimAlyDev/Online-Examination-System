@extends('layout.common-layout')

@section('passwordForgetForm')

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
                            <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                        </div>

                        <form action="{{ route('forgetPassword') }}" method="POST" class="row g-3 needs-validation"
                            novalidate>
                            @csrf
                            <div class="col-12">
                                <label for="yourEmail" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" id="yourEmail" required>
                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Send</button>
                            </div>
                            <div class="col-12">
                                <p class="small mb-0">Remembered your password? <a href="/login">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@section('toaster')
<!-- Ensure Toastr is ready before use -->
<script>
    $(document).ready(function() {
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif

        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    });
</script>
@endsection

@endsection