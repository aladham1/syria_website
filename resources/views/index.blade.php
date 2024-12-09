<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    </x-slot>

    <div class="home-bg" style="background-image: url('{{asset('/')}}assets/images/home-bg.png');">
        <!-- Centered Content -->
        <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
            <!-- Logo -->
            <img src="{{asset('/')}}assets/images/logo.jpg" alt="Logo" class="mb-3" style="max-width: 200px;">
            <h1 class="text-center">حجز تذكرة المزرعة</h1>
            <h4 class="text-center">Book albohayra farm tickets</h4>
            <form class="form" id="loginForm">
                @csrf
                <div class="input-group mb-3">

                    <input type="tel" class="form-control" name="phone" maxlength="8" placeholder="Phone Number">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                +965<i class="custom-flag"></i>
                            </span>
                    </div>
                </div>
                <button class="btn btn-login" type="submit">تسجيل</button>
            </form>
            <div class="wusool-logo mt-4">
                <a href="https://wa.me/{{str_replace(' ','',config('settings.whatsapp'))}}">
                    <img src="{{asset('assets/images/wusool.png')}}" alt="Wusool">
                </a>
            </div>
        </div>


    </div>

    <x-slot name="js">
        <script>
            $(document).ready(function () {
                $('#loginForm').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('login.by.phone') }}",
                        data: $(this).serialize(),
                        success: function (response) {
                            window.location = "{{route('otp_code')}}"
                        },
                        error: function (error) {
                            Swal.fire({
                                title: 'خطأ!',
                                text: "يرجى التأكد من رقم الجوال!",
                                icon: 'error',
                                confirmButtonText: 'حسناً',
                            })
                        }
                    });

                });
            });
        </script>
    </x-slot>
</x-app-layout>
