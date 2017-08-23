
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

import Vue from 'vue'
import VueRouter from 'vue-router'
window.Vue = Vue
Vue.use(VueRouter)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './routes'
import Navigation from './components/Navigation'
import Login from './components/Login'
import CatIndex from './components/CatIndex'

Vue.component('navigation', Navigation)
Vue.component('login', Login)
Vue.component('cat-index', CatIndex)

const app = new Vue({
    el: '#app',
    router,

    data: {
        currentRoute: window.location.pathname,
        isAuthenticated: window.InitialAuthenticated
    },

    methods: {
        toggle() {
            this.isAuthenticated = !this.isAuthenticated
        },

        onMessage(event) {
            console.log('RECEIVED MESSAGE', event)
        }
    }
});
