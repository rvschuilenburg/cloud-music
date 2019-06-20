require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Library from './views/Library'
import Queue from './views/Queue'
import Search from './views/Search'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'queue',
            component: Queue
        },
        {
            path: '/library',
            name: 'library',
            component: Library,
        },
        {
            path: '/search',
            name: 'search',
            component: Search,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});