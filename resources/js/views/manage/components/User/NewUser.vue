<template>
    <form id="kt_modal_add_user_form" class="form " method="post"  @submit.prevent="onSubmit"
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
            <div class="fv-row">
                <label class="fs-5 fw-bolder form-label mb-3">الصلاحيات</label>
                <div class="row">
                    <div class="col-3 mb-3" v-for="role in roles">
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                            <input class="form-check-input" type="checkbox" v-model="form.roles"  :value="role.id" name="roles" />
                            <span class="form-check-label">{{role.title}}</span>
                        </label>
                    </div>

                </div>
                <span v-if="form.errors.has('roles')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('roles')"></span>
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
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">إضافة</span>
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
    name: "NewUser",
    props:['roles','type'],
    data() {
        return {
            form: new Form({
                email: '',
                name: '',
                phone: '',
                password: '',
                login_code: '',
                roles: []
            }),
            'postProgress': false,
        }
    },
    methods:{
        onSubmit() {
            this.postProgress = true;
            this.form.post(url_site + 'users')
                .then(user => this.$emit('completed', user));
            this.postProgress = false;
        },
    },
}
</script>

<style scoped>

</style>
