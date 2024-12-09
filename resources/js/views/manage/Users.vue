<template>
    <div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                              height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                              fill="black"></rect>
														<path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="black"></path>
													</svg>
												</span>
                        <input type="text"
                               v-model="searchQuery" @keyup="search"
                               class="form-control form-control-solid w-250px ps-14"
                               placeholder="البحث عن مدير">
                    </div>
                </div>
                <div class="card-toolbar">
                    <button class="btn btn-light-primary" v-if="deleted" type="button" @click="getDeleted">
                       المدراء
                    </button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="velmld-overlay" v-if="loading"
                     style="background-color: rgba(255, 255, 255, 0.7);/* display: none; */">
                    <div class="velmld-spinner">
                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px"
                             viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve"><path opacity="0.2" fill="#00dd99" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
                            <path
                                fill="#00dd99" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
    C22.32,8.481,24.301,9.057,26.013,10.047z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.6s" repeatCount="indefinite"></animateTransform></path></svg>
                        <!----></div>
                </div>
                <div class="table-responsive">
                    <table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
                        <thead>
                        <tr class="fw-bold fs-6 text-muted">
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>رقم الجوال</th>
                            <th v-if="!type">الصلاحيات</th>
                            <th v-if="type">رمز الدخول</th>
                            <th class="text-center" v-if="can_delete || can_edit">التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user, index) in users.data">
                            <td>{{ (current_page * 20) - 20 + index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.phone }}</td>
                            <td v-if="!type">
                              <span v-for="role in user.roles" class="badge m-2 badge-light-primary"> {{ role.title }}
                            </span>
                            </td>
                            <td v-if="type">{{ user.login_code }}</td>
                            <td class="text-center">
                                <a href="javascript:;" v-if="can_edit && !deleted" @click="editUser(user)"
                                   class="text-primary me-2">
                                    <i class="las la-pencil-alt text-primary fs-2x"></i>
                                </a>

                                <a href="javascript:;" v-if="can_delete" @click="deleteUser(user)" class="text-danger ">
                                    <i class="las la-trash text-danger fs-2x"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
            </div>
        </div>

        <div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>إضافة مدير جديد</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
								</svg>
							</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <new-user :roles="roles" :type="type" @completed="addNewUserToTable"></new-user>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" v-if="can_edit" id="kt_modal_edit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>تعديل المدير</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
								</svg>
							</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form " method="post"
                              action="/manage/users" @submit.prevent="onSubmit"
                              @keydown="editForm.errors.clear($event.target.name)">
                            <div class="d-flex flex-column me-n7 pe-7">
                                <div class="form-floating mb-7">
                                    <input type="text" v-model="editForm.name" name="name" class="form-control"
                                           id="name"
                                           placeholder="الاسم"/>
                                    <label for="name">الاسم</label>
                                    <span v-if="editForm.errors.has('name')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('name')"></span>
                                </div>
                                <div class="form-floating mb-7">
                                    <input type="email" v-model="editForm.email" name="email" class="form-control"
                                           id="email"
                                           placeholder="البريد الالكتروني"/>
                                    <label for="name">البريد الالكتروني</label>
                                    <span v-if="editForm.errors.has('email')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('email')"></span>
                                </div>
                                <div class="form-floating mb-7">
                                    <input type="text" v-model="editForm.phone" name="phone" class="form-control"
                                           id="phone"
                                           placeholder="رقم الجوال"/>
                                    <label for="name">رقم الجوال</label>
                                    <span v-if="editForm.errors.has('phone')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('phone')"></span>
                                </div>
                                <div class="form-floating mb-7 mt-5" v-if="type">
                                    <input type="text" v-model="editForm.login_code" name="login_code" class="form-control"
                                           id="login_code"
                                           placeholder="رمز الدخول"/>
                                    <label for="login_code">رمز الدخول</label>
                                    <span v-if="editForm.errors.has('login_code')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('login_code')"></span>
                                </div>
                                <div class="form-floating mb-7 mt-5" v-if="!type">
                                    <input type="password" v-model="editForm.password" name="password"
                                           class="form-control"
                                           id="password"
                                           placeholder="كلمة المرور"/>
                                    <label for="name">كلمة المرور</label>
                                    <span v-if="editForm.errors.has('password')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('password')"></span>
                                </div>
                                <div class="fv-row" v-if="!type">
                                    <label class="fs-5 fw-bolder form-label mb-3">الصلاحيات</label>
                                    <div class="row">
                                        <div class="col-3 mb-3" v-for="role in roles">
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" v-model="editForm.roles"
                                                       :value="role.id" name="roles"/>
                                                <span class="form-check-label">{{ role.title }}</span>
                                            </label>
                                        </div>

                                    </div>
                                    <span v-if="editForm.errors.has('roles')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('roles')"></span>
                                </div>
                            </div>
                            <div class="text-center pt-15">
                                <button type="submit" :disabled="editForm.errors.any()" class="btn btn-primary">
                                    <span class="indicator-label">تحديث</span>
                                    <span class="" v-if="postProgressEdit">
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import NewUser from "./components/User/NewUser";

export default {
    name: "Visitors",
    components: {NewUser},
    props: ['can_edit', 'can_delete','type'],
    data() {
        return {
            users: {},
            roles: [],
            'loading': false,
            searchQuery: null,
            deleted: null,
            current_page: null,
            postProgressEdit: false,
            editForm: new Form({
                id: '',
                email: '',
                login_code: '',
                name: '',
                phone: '',
                password: '',
                roles: [],
            }),
        }
    }
    ,
    mounted() {
        this.getResults();
        axios.get(url_site + 'get-roles/')
            .then((response) => {
                this.roles = response.data;
            });
    },

    methods: {
        getResults(page = 1, query = null) {
            this.loading = true;
            let type = this.type ? '&type=1' : '';
            axios.get(url_site + 'get-users/?page=' + page + '&query=' + query + type )
                .then((response) => {
                    this.users = response.data;
                    this.current_page = response.data.current_page;
                    this.loading = false
                });
        },
        addNewUserToTable(user) {
            this.users.data.unshift(user);
            Swal.fire({
                text: "تم إضافة المدير بنجاح!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "حسناً",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            $('#kt_modal_create_app').modal('hide')
        },
        deleteUser(user) {
            Swal.fire({
                html: `هل انت متاكد من حذف ${user.name} ؟`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "نعم!",
                cancelButtonText: 'لا',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url_site + 'users/' + user.id)
                        .then((response) => {
                            this.users.data = this.users.data.filter(obj => {
                                return obj.id != user.id;
                            });
                            Swal.fire({
                                text: "تم حذف المدير بنجاح!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "حسناً",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }).catch(error => {
                        this.errorMessageSwal();
                    });
                }
            });

        },
        errorMessageSwal() {
            this.postProgressEdit = false;
            Swal.fire({
                text: "حدث خطأ ما، يرجى المحاولة فما بعد!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "حسناً",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        },
        editUser(user) {
            $('#kt_modal_edit').modal('show');
            this.editForm.id = user.id;
            this.editForm.email = user.email;
            this.editForm.name = user.name;
            this.editForm.phone = user.phone;
            this.editForm.user_type = user.is_admin ? 'admin' : 'user';
            this.editForm.login_code = user.login_code;
            this.editForm.roles = user.roles.map(e => e.id);
        },
        search() {
            this.getResults(1, this.searchQuery);
        },
        onSubmit() {
            this.postProgressEdit = true;
            this.editForm.put(url_site + 'users/' + this.editForm.id)
                .then(response => this.users.data.map(user => {
                    $('#kt_modal_edit').modal('hide');
                    Swal.fire({
                        text: "تم تعديل المدير بنجاح!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "حسناً",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    this.postProgressEdit = false;
                    if (user.id == response.id) {
                        for (let key in response) {
                            user[key] = response[key];
                        }
                    }
                })).catch(error => {
                this.errorMessageSwal();
            });


        },

    },
}
</script>

<style scoped>

</style>
