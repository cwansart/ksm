
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//import routes from './routes'

import Navigation from './components/Navigation'
import Login from './components/Login'
import CatIndex from './components/CatIndex'

Vue.component('navigation', Navigation)
Vue.component('login', Login)
Vue.component('cat-index', CatIndex)

const app = new Vue({
    el: '#app',
    data: {
        currentRoute: window.location.pathname,
        isAuthenticated: false
    },

    mounted() {
        axios.get('/check')
        .then(response => {
            this.isAuthenticated = response.data.is_authenticated ? true : false;
        })
        .catch(error => {
            console.error('error on check', error)
        })
    }
});
