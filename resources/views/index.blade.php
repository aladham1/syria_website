<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    </x-slot>

    <div class="home-bg" style="background-image: url('{{asset('/')}}assets/images/home-bg.png');">
        <!-- Centered Content -->
        <div class="d-flex flex-column ">
            <header class="text-center py-4">
                <div class="container">
                    <img src="{{asset('assets/images/logo.jpg')}}" alt="الشعار" class="rounded-circle mb-2 logo">
                    <h1 class="h-title-a">خدمة البحث عن المفرَج عنهم: دعم التواصل والشفافية</h1>
                </div>
            </header>

            <div class="container mt-5">
                <div class="text-center mb-4">
                    <p class="text-page">تعد قاعدة البيانات هذه خدمة مخصصة للبحث عن المسجونين الذين تم إخلاء سبيلهم. تهدف إلى توفير
                        المعلومات بشكل دقيق وشفاف لجميع الأفراد، مع الالتزام التام بالخصوصية واحترام القيم الإنسانية
                        والاجتماعية. يتم استخدام هذه الخدمة لتسهيل التواصل مع الأفراد المعنيين وتمكين ذويهم أو الجهات
                        المختصة من متابعة حالتهم بطريقة آمنة وسهلة.</p>
                </div>
                <form id="searchForm" class="mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-lg" placeholder="اكتب الاسم هنا"
                                   required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100">بحث</button>
                        </div>
                    </div>
                </form>

                <div id="resultsSection" class="d-none">
                    <h3 class="text-center text-primary mb-3" style="color: #d2232a;">النتائج:</h3>
                    <ul id="resultsList" class="list-group"></ul>
                </div>
            </div>


        </div>


    </div>

    <x-slot name="js">
        <script>
            $(document).ready(function () {
                {{--$('#loginForm').submit(function (e) {--}}
                {{--    e.preventDefault();--}}
                {{--    $.ajax({--}}
                {{--        type: 'POST',--}}
                {{--        url: "{{ route('login.by.phone') }}",--}}
                {{--        data: $(this).serialize(),--}}
                {{--        success: function (response) {--}}
                {{--            window.location = "{{route('otp_code')}}"--}}
                {{--        },--}}
                {{--        error: function (error) {--}}
                {{--            Swal.fire({--}}
                {{--                title: 'خطأ!',--}}
                {{--                text: "يرجى التأكد من رقم الجوال!",--}}
                {{--                icon: 'error',--}}
                {{--                confirmButtonText: 'حسناً',--}}
                {{--            })--}}
                {{--        }--}}
                {{--    });--}}

                {{--});--}}
            });
        </script>
    </x-slot>
</x-app-layout>
