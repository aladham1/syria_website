<x-auth-login>
    <form class="form w-100" method="POST" action="{{ route('password.email') }}"
          novalidate="novalidate" id="kt_password_reset_form">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">{{ucwords(__('common.forget_password'))}}</h1>
            <div class="text-gray-400 fw-bold fs-4">أدخل بريدك الالكتروني لاستعادة كلمة المرور</div>
        </div>
                    <div class="text-success">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                    </div>

        <div class="errors">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6">البريد الالكتروني</label>
            <input class="form-control form-control-solid" type="email" placeholder="" value="{{old('email')}}"
                   name="email" autocomplete="off"/>
        </div>

        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                <span class="indicator-label">استعادة كلمة المرور</span>
            </button>
            <a href="{{route('login')}}" class="btn btn-lg btn-light-primary fw-bolder">الغاء</a>
        </div>
    </form>

</x-auth-login>

<slot slot="js">
    <script src="{{asset('assets/js/custom/authentication/password-reset/password-reset.js')}}"></script>
</slot>
