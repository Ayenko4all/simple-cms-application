/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Vue from 'vue';
import router from './Routes/index.js';
import  VueRouter from 'vue-router';
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VueRouter);

import store from "./Store/index.js";
import App from "./App.vue";


 new Vue({
    el: '#app',
    router: router,
    store,
     components: {App}
});
