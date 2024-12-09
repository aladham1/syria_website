require('./bootstrap-manage');


import Form from "./core/Form";
import Roles from "./views/manage/Roles/Roles";
import Users from "./views/manage/Users.vue";
import Prisoners from "./views/manage/Prisoners/Prisoners.vue";
import NewPrisoner from "./views/manage/Prisoners/NewPrisoner.vue";
import MyAccount from "./views/manage/components/User/MyAccount.vue";
import Setting from "./core/Setting";

window.Form = Form;


new Vue({
    el: '#kt_content',
    components: {
        Roles,
        Users,
        Prisoners,
        NewPrisoner,
        MyAccount
    },
})
