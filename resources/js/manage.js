require('./bootstrap-manage');


import Form from "./core/Form";
import Roles from "./views/manage/Roles/Roles";
import Users from "./views/manage/Users.vue";
import Setting from "./core/Setting";

window.Form = Form;


new Vue({
    el: '#kt_content',
    components: {
        Roles,
        Users,
    },
})
