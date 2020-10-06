/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from 'vue-router';
import routes from './routes';
import auth from './helpers/auth';
import Paginate from 'vuejs-paginate';

require('./bootstrap');

window.Vue = require('vue');
window.Vue.use(VueRouter);
Vue.component('paginate', Paginate);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

 router.beforeEach((to, from, next) => {
     if (to.matched.some(record => record.meta.needAuth)) {
         if (auth.isLoggedIn()) {
            next();
        } else {
            next({ name: 'login' });
        }
     } else if (to.matched.some(record => record.meta.guest)) {
         if (auth.isLoggedIn()) {
             next({ name: 'home' });
        } else {
            next();
         }
     } else {
         next();
     }
 });

 window.BASE_URL_API = $('#app').data('url');

const app = new Vue({
    el: '#app',
    router
});
