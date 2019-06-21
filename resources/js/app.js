require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlay, faPause, faStop, faTrash, faList, faSearch, faSave } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faPlay, faPause, faStop, faTrash, faList, faSearch, faSave)
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(VueRouter)
Vue.config.productionTip = false

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