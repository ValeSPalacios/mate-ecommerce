require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import VueSweetAlert2 from 'vue-sweetalert2';
import Appmainvue from './components/App.vue';
import CartClient from './components/Carts/Index.vue';

Vue.use(VueRouter);
Vue.use(VueSweetAlert2);
// importamos los estilos de Sweet Alert 2
import "sweetalert2/dist/sweetalert2.min.css";

const router = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/cart/index',
            component:CartClient,
            name:'cart.index'
        },
    ]
})

/* Vue.component('comments-index',require('./components/Comments/Index.vue').default); */

Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el:'#appVue',
    components:{Appmainvue,CartClient},
    template: '<CartClient></CartClient>',
    router
});
