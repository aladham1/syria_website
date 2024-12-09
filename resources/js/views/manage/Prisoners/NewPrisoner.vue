<template>
    <form id="kt_modal_add_user_form" class="form " method="post"
          action="" @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.name)">
        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
            <div class="fv-row mb-10">
                <label class="fs-5 fw-bolder form-label mb-2">
                    <span class="required">اسم السجين</span>
                </label>
                <input class="form-control form-control-solid" v-model="form.name" placeholder="اسم السجين" name="name" />
                <span v-if="form.errors.has('name')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('name')"></span>
            </div>
            <div class="fv-row mb-10">
                <label class="fs-5 fw-bolder form-label mb-2">
                    <span class="">السجن</span>
                </label>
                <input class="form-control form-control-solid" v-model="form.prison" placeholder="السجن" name="prison" />
                <span v-if="form.errors.has('prison')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('prison')"></span>
            </div>


        </div>
        <div class="text-center pt-15">
            <button type="submit"  class="btn btn-primary">
                <span class="indicator-label">حفظ</span>
                <span class="" v-if="postProgress">انتظر ...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>

</template>

<script>
export default {
    name: "NewPrisoner",
    data() {
        return {
            form: new Form({
                name: '',
                prison: '',
            }),
            'postProgress': false,
        }
    },
    methods:{
        onSubmit() {
            this.postProgress = true;
            this.form.post(url_site +'prisoners')
                .then(prisoner => this.$emit('completed', prisoner));
            this.postProgress = false;
        },

    },
}
</script>

<style scoped>

</style>
