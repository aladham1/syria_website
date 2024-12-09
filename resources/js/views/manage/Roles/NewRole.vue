<template>
    <form id="kt_modal_add_user_form" class="form " method="post"
          action="" @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.name)">
        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
            <div class="fv-row mb-10">
                <label class="fs-5 fw-bolder form-label mb-2">
                    <span class="required">Title</span>
                </label>
                <input class="form-control form-control-solid" v-model="form.title" placeholder="Role title" name="title" />
                <span v-if="form.errors.has('title')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('title')"></span>
            </div>
            <div class="fv-row">
                <label class="fs-5 fw-bolder form-label mb-2">Roles</label>
              <div class="row"  v-for="(ability, index) in abilities">
                  <div class="col-12 mt-4 mb-3">
                      <label class="form-check form-check-sm form-check-custom form-check-solid me-5" >
                          <input @change="selectAll($event)" :data-role-key="index" class="form-check-input" type="checkbox" />
                          <h4 class="form-check-label">{{index}}</h4>
                      </label>
                  </div>
                  <div class="col-3 mb-4"  v-for="(item, key) in ability">
                      <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                          <input  class="form-check-input" :data-role="index"
                                  type="checkbox" v-model="form.abilities" :value="key" name="abilities" />
                          <span class="form-check-label">{{item}}</span>
                      </label>
                  </div>
              </div>
                <span v-if="form.errors.has('abilities')"
                      class="fv-plugins-message-container invalid-feedback"
                      v-text="form.errors.get('abilities')"></span>
            </div>
        </div>
        <div class="text-center pt-15">
            <button type="submit"  class="btn btn-primary">
                <span class="indicator-label">Add</span>
                <span class="" v-if="postProgress">Wait ...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>

</template>

<script>
export default {
    name: "NewRole",
    props:['abilities'],
    data() {
        return {
            form: new Form({
                title: '',
                abilities: [],
            }),
            'postProgress': false,
        }
    },
    methods:{
        onSubmit() {
            this.postProgress = true;
            this.form.post(url_site +'roles')
                .then(role => this.$emit('completed', role));
            this.postProgress = false;
        },
        selectAll(e){
            let role = e.target.getAttribute('data-role-key')
            const roles= document.querySelectorAll(`[data-role="`+role+`"]`);
            if (e.target.checked) {
                roles.forEach(btn =>{
                    console.log(btn)
                    btn.checked = 'checked';
                    this.form.abilities.push(btn.value);
                });
            }else{
                roles.forEach(btn =>{
                    console.log(btn.value)
                     btn.checked = '';
                    this.removeItem(this.form.abilities,btn.value)
                });
            }
        },
        removeItem(array, item){
            for(var i in array){
                if(array[i]==item){
                    array.splice(i,1);
                    break;
                }
            }
        }

    },
}
</script>

<style scoped>

</style>
