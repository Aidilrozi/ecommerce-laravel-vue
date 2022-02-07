window.Vue = require("vue").default;

import axios from 'axios'
import VueAxios from 'vue-axios'
import '../css/tailwind.css';
Vue.use(VueAxios, axios)

import App from './components/App.vue'
import ProductListing from './components/ProductListing.vue'
import Layout from './components/Layout'
import ProductDetail from './components/Product/ProductDetail'
import CartTable from './components/Cart/index.vue'
import Checkout from './components/Checkout/index.vue'
import Login from './components/Login/index.vue'
import { library } from '@fortawesome/fontawesome-svg-core'

import { faHatWizard } from '@fortawesome/free-solid-svg-icons'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import store from './store'
// import { routes } from './routes';
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
    {   path: '/app/home', 
        component: ProductListing,
        // redirect:{
        //     name:'login'
        // },
        // beforeEnter:(to,from,next) => {
        //     if(1===0){
        //         next('/app/login');
        //     }else{
        //         next();
        //     }
        // } 
    },
    { path: '/app/login', component: Login,name:'login' },
    { path: '/app/product', component: ProductDetail },
    { path: '/app/cart', component: CartTable },
    {
        path: '/app/details/:id',
        name: 'Details',
        component: ProductDetail,
        
    },
    { path: '/app/checkout', component: Checkout },
  
]
axios.interceptors.response.use(
    function(response) {
        // Call was successful, don't do anything special.
        return response;
    },
    function (error) {
    switch (error.response.status) {
        case 401: // Not logged in
          this.$router.push('/app/login') 
          break;
        case 419: // Session expired
        case 503: // Down for maintenance
            // Bounce the user to the login screen with a redirect back
            this.$router.replace('/app/login')
            break;
        case 500:
            alert('Oops, something went wrong!  The team have been notified.');
            break;
        default:
            // Allow individual requests to handle other errors
            return Promise.reject(error);
    }
});

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})
library.add(faUserSecret)
const app = new Vue({
    store,
    el: '#app',
    router,
    render: h => h(App)
});
Vue.component('font-awesome-icon', FontAwesomeIcon)