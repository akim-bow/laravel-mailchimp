require('./bootstrap');
// import * as mdb from 'mdb-ui-kit';

import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router';
import App from '../vue/App.vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

import router_module from '../vue/modules/router';
const router = new VueRouter(router_module);

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        axios.post('/user').then(res => {
            if (res.data.status !== 'ok') {
                next('/login');
            }
        }).catch(err => {
            next('login');
        });
    }
    next();
});

new Vue({
    el: '#app',
    components: { App },
    router
});

