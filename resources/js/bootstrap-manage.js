import Vue from "vue";
import axios from "axios";

window.Vue = Vue;
Vue.component('pagination', require('laravel-vue-pagination'));



Vue.directive('select', {
    twoWay: true,
    bind: function (el, binding, vnode) {
        $(document).ready(function () {
            $(el).select2().on("select2:select", (e) => {
               el.dispatchEvent(new Event('change', {target: e.target}));
            });
            $(el).select2().on("select2:unselect", (e) => {
                el.dispatchEvent(new Event('change',  {target: null}));

            });
        });
    },
    componentUpdated: function (el, me) {
     $(el).trigger("change");
    }
});

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
