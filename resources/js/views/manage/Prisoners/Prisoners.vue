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
                               placeholder="السجناء">
                    </div>
                </div>
                <div class="card-toolbar"></div>
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
                            <th>السجن</th>
                            <th class="text-center">عمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(prisoner, index) in prisoners.data">
                            <td>{{ (current_page * 20) - 20 + index + 1 }}</td>

                            <td>{{ prisoner.name }}</td>
                            <td>{{ prisoner.prison }}</td>
                            <td class="text-center">
                                <a href="javascript:;" @click="editPrisoner(prisoner)"
                                   class="text-primary me-2">
                                    <i class="las la-pencil-alt text-primary fs-2x"></i>
                                </a>

                                <a href="javascript:;" @click="deletePrisoner(prisoner)" class="text-danger ">
                                    <i class="las la-trash text-danger fs-2x"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination :data="prisoners" @pagination-change-page="getResults"></pagination>

                </div>
            </div>
        </div>

        <div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bolder">إضافة سجين</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-plans-modal-action="close">
                            <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                  rx="1" transform="rotate(-45 6 17.3137)"
                                                                  fill="black"></rect>
															<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                  transform="rotate(45 7.41422 6)" fill="black"></rect>
														</svg>
													</span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-lg-5 my-7">
                        <new-prisoner @completed="addNewPrisonerToTable"></new-prisoner>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_edit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>تعديل</h2>
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
                              action="" @submit.prevent="onSubmit"
                              @keydown="editForm.errors.clear($event.target.name)">
                            <div class="d-flex flex-column me-n7 pe-7">
                                <div class="form-floating mb-7">
                                    <input type="text" v-model="editForm.name" name="name" class="form-control"
                                           id="title"
                                           placeholder="الاسم"/>
                                    <label for="title">الاسم</label>
                                    <span v-if="editForm.errors.has('name')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('name')"></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column me-n7 pe-7">
                                <div class="form-floating mb-7">
                                    <input type="text" v-model="editForm.prison" name="prison" class="form-control"
                                           id="title"
                                           placeholder="السجن"/>
                                    <label for="title">السجن</label>
                                    <span v-if="editForm.errors.has('prison')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('prison')"></span>
                                </div>
                            </div>

                            <div class="text-center pt-15">
                                <button type="submit" :disabled="editForm.errors.any()" class="btn btn-primary">
                                    <span class="indicator-label">حفظ</span>
                                    <span class="" v-if="postProgress">
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
import NewPrisoner from "./NewPrisoner.vue";

export default {
    name: "prisoners",
    components: {NewPrisoner},
    data() {
        return {
            current_page: null,
            prisoners: {},
            'loading': false,
            searchQuery: null,
            'postProgress': false,
            editForm: new Form({
                id: '',
                name: '',
                prison: '',
            }),
        }
    }
    ,
    mounted() {
        this.getResults();
    },

    methods: {
        getResults(page = 1, query = null) {
            this.loading = true;
            axios.get(url_site + 'get-prisoners/?page=' + page + '&query=' + query)
                .then((response) => {
                    this.prisoners = response.data;
                    this.current_page = response.data.current_page;
                    this.loading = false
                });
        },
        addNewPrisonerToTable(prisoner) {
            this.prisoners.data.unshift(prisoner);
            Swal.fire({
                text: "تم اضافة السجين بنجاح!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            $('#kt_modal_create_app').modal('hide')
        },
        deletePrisoner(prisoner) {
            Swal.fire({
                html: `هل انت متاكد من حذف ${prisoner.name} ؟`,
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
                    axios.delete(url_site + 'prisoners/' + prisoner.id)
                        .then((response) => {
                            this.prisoners.data = this.prisoners.data.filter(obj => {
                                return obj.id != prisoner.id;
                            });
                            Swal.fire({
                                text: "تم حذف الاسير بنجاح!",
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
        editPrisoner(prisoner) {
            $('#kt_modal_edit').modal('show');
            this.editForm.id = prisoner.id;
            this.editForm.name = prisoner.name;
            this.editForm.prison = prisoner.prison;
        },
        search() {
            this.getResults(1, this.searchQuery);
        },
        onSubmit() {
            this.postProgress = true;
            this.editForm.put(url_site + 'prisoners/' + this.editForm.id)
                .then(response => this.prisoners.data.map(prisoner => {
                    $('#kt_modal_edit').modal('hide');
                    Swal.fire({
                        text: "تم تحديث السجين بنجاح",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "حسناً",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    this.postProgress = false;
                    if (prisoner.id == response.id) {
                        for (let key in response) {
                            prisoner[key] = response[key];
                        }
                    }
                })).catch(error => {
                this.postProgress = false;

            });


        },

    },
}
</script>

<style scoped>

</style>
