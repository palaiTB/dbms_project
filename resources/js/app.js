/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Gate from './Gate'
Vue.prototype.$gate = new Gate(window.user)

Vue.use(VueRouter)

import Papers from './components/Papers.vue'
import Upload from './components/Upload.vue'
import Profile from './components/Profile.vue'
// import Solutions from "./components/Solutions";

let routes = [
    {path: '/papers', component: Papers},
    {path: '/upload', component: Upload},
    {path: '/profile', component: Profile},
    // {path: '/solutions', component: Solutions},
]

let router = new VueRouter({
    mode: 'history',
    routes
});

import {Form, HasError, AlertError} from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

// CommonJS
window.Swal = Swal
//Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})
window.Toast = Toast

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

window.Fire = new Vue();

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'not-found',
    require('./components/Notfound.vue').default
);

import VModal from 'vue-js-modal'

Vue.use(VModal)

import VueDisqus from 'vue-disqus'

Vue.use(VueDisqus)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
