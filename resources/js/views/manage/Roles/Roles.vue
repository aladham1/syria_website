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
                               placeholder="Roles">
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
                            <th>Title</th>
                            <th>Roles</th>
                            <th class="text-center" v-if="can_edit || can_delete">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="role in roles">
                            <td>{{ role.title }}</td>
                            <td>
                            <span v-for="(abilitie, index) in abilities">
                                <span v-for="(item, key) in abilitie" v-if="role.abilities.includes(key)"
                                      class="badge m-2 badge-light-primary">
                                    {{ item }}</span>

                            </span>
                            </td>
                            <td class="text-center">
                                <a v-if="can_edit" href="javascript:;" @click="editRole(role)"
                                   class="text-primary me-2">
                                    <i class="las la-pencil-alt text-primary fs-2x"></i>
                                </a>

                                <a v-if="can_delete" href="javascript:;" @click="deleteRole(role)" class="text-danger ">
                                    <i class="las la-trash text-danger fs-2x"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bolder">Add New Role</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
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
                        <new-role :abilities="abilities" @completed="addNewRoleToTable"></new-role>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_edit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-850px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Role</h2>
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
                                    <input type="text" v-model="editForm.title" name="title" class="form-control"
                                           id="title"
                                           placeholder="Title"/>
                                    <label for="title">Title</label>
                                    <span v-if="editForm.errors.has('title')"
                                          class="fv-plugins-message-container invalid-feedback"
                                          v-text="editForm.errors.get('title')"></span>
                                </div>
                            </div>
                            <div class="fv-row">
                                <label class="fs-5 fw-bolder form-label mb-2">Roles</label>
                                <div class="row" v-for="(ability, index) in abilities">
                                    <div class="col-12 mt-4 mb-3">
                                        <h5> {{ index }}</h5>
                                    </div>
                                    <div class="col-3 mb-3" v-for="(item, key) in ability">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" v-model="editForm.abilities"
                                                   :value="key" name="abilities"/>
                                            <span class="form-check-label">{{ item }}</span>
                                        </label>
                                    </div>
                                </div>
                                <span v-if="editForm.errors.has('abilities')"
                                      class="fv-plugins-message-container invalid-feedback"
                                      v-text="editForm.errors.get('abilities')"></span>
                            </div>
                            <div class="text-center pt-15">
                                <button type="submit" :disabled="editForm.errors.any()" class="btn btn-primary">
                                    <span class="indicator-label">Save</span>
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
import NewRole from "./NewRole";

export default {
    name: "roles",
    components: {NewRole},
    props: ['can_edit', 'can_delete'],
    data() {
        return {
            roles: [],
            abilities: [],
            'loading': false,
            searchQuery: null,
            'postProgress': false,
            editForm: new Form({
                id: '',
                title: '',
                abilities: [],
            }),
        }
    }
    ,
    mounted() {
        this.getResults();
        axios.get(url_site + 'get-abilities')
            .then((response) => {
                this.abilities = response.data;
            });
    },

    methods: {
        getResults(query = null) {
            this.loading = true;
            axios.get(url_site + 'get-roles/' + '?query=' + query)
                .then((response) => {
                    this.roles = response.data;
                    this.loading = false
                });
        },
        addNewRoleToTable(role) {
            this.roles.unshift(role);
            Swal.fire({
                text: "Added successfully!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            $('#kt_modal_create_app').modal('hide')
        },
        deleteRole(role) {
            Swal.fire({
                html: `Are you sure?`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: 'No',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url_site + 'roles/' + role.id)
                        .then((response) => {
                            this.roles = this.roles.filter(obj => {
                                return obj.id != role.id;
                            });
                            Swal.fire({
                                text: "Deleted Successfully!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }).catch(error => {
                        Swal.fire({
                            text: "Sorry, there was a problem",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        });
                    });
                }
            });

        },
        editRole(role) {
            $('#kt_modal_edit').modal('show');
            this.editForm.id = role.id;
            this.editForm.title = role.title;
            this.editForm.abilities = role.abilities;
        },
        search() {
            this.getResults( this.searchQuery);
        },
        onSubmit() {
            this.postProgress = true;
            this.editForm.put(url_site + 'roles/' + this.editForm.id)
                .then(response => this.roles.map(role => {
                    $('#kt_modal_edit').modal('hide');
                    Swal.fire({
                        text: "Updated Successfully",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    this.postProgress = false;
                    if (role.id == response.id) {
                        for (let key in response) {
                            role[key] = response[key];
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
