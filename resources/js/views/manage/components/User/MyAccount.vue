<template>
    <form id="kt_modal_add_user_form" class="form " method="post" @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.name)">
        <div class="d-flex flex-column me-n7 pe-7">
            <div class="form-floating mb-7">
                <input type="text" v-model="form.name" name="name" class="form-control" id="name"
                       placeholder="الاسم"/>
                <label for="name">الاسم</label>
                <span v-if="form.errors.has('name')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('name')"></span>
            </div>
            <div class="form-floating mb-7">
                <input type="email" v-model="form.email" name="email" class="form-control"
                       id="email"
                       placeholder="البريد الالكتروني"/>
                <label for="name">البريد الالكتروني</label>
                <span v-if="form.errors.has('email')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('email')"></span>
            </div>
            <div class="form-floating mb-7">
                <input type="text" v-model="form.phone" name="phone" class="form-control" id="phone"
                       placeholder="رقم الجوال"/>
                <label for="name">رقم الجوال</label>
                <span v-if="form.errors.has('phone')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('phone')"></span>
            </div>
            <div class="form-floating mb-7 mt-5">
                <input type="password" v-model="form.password" name="password" class="form-control"
                       id="password"
                       placeholder="كلمة المرور"/>
                <label for="name">كلمة المرور</label>
                <span v-if="form.errors.has('password')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('password')"></span>
            </div>
        </div>
        <div class="text-center pt-15">
            <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">
                <span class="indicator-label">حفظ</span>
                <span class="" v-if="postProgress">انتظر ...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <!--end::Actions-->
        <div></div>
    </form>
</template>

<script>
export default {
    name: "MyAccount",
    props: ['user'],
    data() {
        return {
            form: new Form({
                email: this.user.email,
                name: this.user.name,
                phone: this.user.phone,
                password: '',
            }),
            'postProgress': false,
        }
    },
    methods: {
        onSubmit() {
            this.postProgressEdit = true;
            this.form.put(url_site + 'my-account',true)
                .then(response => {
                        Swal.fire({
                            text: "تم تعديل حسابك بنجاح!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "حسناً",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                ).catch(error => {
                this.errorMessageSwal();
            });
        },
    },
}
</script>

<style scoped>

</style>
