<x-auth-login title="Login">
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
          method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">تسجيل الدخول</h1>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="errors">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
            <input class="form-control form-control-lg form-control-solid"
                   type="email" name="email" value="{{old('email')}}" />
        </div>
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0"> </label>

                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">
                        {{__('Forget password')}}؟
                    </a>

            </div>
            <input class="form-control form-control-lg form-control-solid"
                   type="password"  name="password" autocomplete="off" />
        </div>
        <div class="block mb-5">
            <label class="form-check form-check-custom form-check-solid me-10">
                <input class="form-check-input h-20px w-20px" type="checkbox" name="remember">
                <span class="form-check-label fw-bold">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="text-center">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">{{__('Login')}}</span>
                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>

</x-auth-login>
<slot name="js">
    <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
</slot>
