<x-auth-login>

        <!-- Validation Errors -->
       <div class="errors">
           <x-auth-validation-errors class="mb-4" :errors="$errors" />
       </div>

        <form method="POST" class="form w-100" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">البريد الالكتروني</label>
                    <input class="form-control form-control-solid" type="email" value="{{old('email', $request->email)}}" required autofocus
                           name="email"/>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">كلمة المرور</label>
                    <input class="form-control form-control-solid" type="password" required
                           name="password"/>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">تأكيد كلمة المرور</label>
                    <input class="form-control form-control-solid" type="password" required
                           name="password_confirmation"/>
                </div>

                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">
                        <span class="indicator-label">استعادة كلمة المرور</span>
                    </button>
                </div>
        </form>
</x-auth-login>
