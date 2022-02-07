
<template>
 <div class="flex flex-col justify-between ">
    
    <header class="border-b border-palette-lighter sticky top-0 z-20 bg-white">
      <div class="flex items-center justify-between mx-auto max-w-6xl px-6 pb-2 pt-4 md:pt-6">
          <router-link to="/app/home"><i class="fa fa-home"></i>    <a class=" cursor-pointer">
            <h1 class="flex no-underline">
              <img height="32" width="32" alt="logo" class="h-8 w-8 mr-1 object-contain" src="/images/icon.svg" />
              <span class="text-xl font-primary font-bold tracking-tight pt-1">
               Doggy Stickers
              </span>
            </h1>
          </a></router-link>

        <div>
        <div v-if="this.$store.state.isAuthenticated" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <a  v-on:click.prevent="goToCart" class=" relative" aria-label="cart">
              <div>
                  <font-awesome-icon :icon="cart" class="text-palette-primary w-6 m-auto" fixed-width size="lg" />
              </div>
              <div class="absolute top-0 right-0 text-xs bg-yellow-300 text-gray-900 font-semibold rounded-full py-1 px-2 transform translate-x-3 -translate-y-3">
                {{productCarts}}
              </div>             
          </a>   
         
          <!-- Profile dropdown -->
          <div class="ml-3 relative" >
            <div>
              <button @click="toggleOpen" type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://i.pinimg.com/564x/7d/34/d9/7d34d9d53640af5cfd2614c57dfa7f13.jpg" alt="">
              </button>
            </div>

            <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div :class="openUserMenu?'origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none ':'origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden'" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
              <router-link to="/app/checkout"><a class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Order History</a></router-link>
              <a  v-on:click.prevent="handleLogout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            </div>
          </div>
        </div>
        <div v-else class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <router-link to="/app/login"> 
             <a  class=" relative" aria-label="cart">
             Login          
          </a>   </router-link>
         
         
 
        </div>
        <!-- <a class=" relative" aria-label="cart">
            <div>
                <font-awesome-icon :icon="cart" class="text-palette-primary w-6 m-auto" fixed-width size="lg" />
            </div>
            <div class="absolute top-0 right-0 text-xs bg-yellow-300 text-gray-900 font-semibold rounded-full py-1 px-2 transform translate-x-10 -translate-y-3">
              3
            </div>             
        </a>
           -->
        
        </div>
      </div>
    </header>
  
    <router-view></router-view>

  <div  v-if="this.$store.state.loader" wire:loading class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
	<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
	<h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
	<p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
</div>
        <!-- <Footer /> -->
</div>
  
    
</template>

<script>
// import Nav from './Nav'
import ProductCard from './ProductCard.vue'
import ProductListing from './ProductListing'
import { faAddressCard,faShoppingBag,faShoppingCart } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faSpinner } from '@fortawesome/free-solid-svg-icons'
import { doggyIcon} from '../../assets/icon.svg'
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.withCredentials = true;
import {
    // importando algumas mutations, para adicionar e remover do carrinho
    ISAUTHENTICATED,
    LOAD
  } from '../store/mutation-types'
axios.interceptors.response.use(
    function(response) {
        // Call was successful, don't do anything special.
        return response;
    },
    function (error) {
    switch (error.response.status) {
        case 401:
              // alert('Oops, Unauthorized');
              if(window.location.pathname !== '/app/login'){
                  window.location.replace('/app/login');
              }
              
              //this.$router.push('/app/login') 
              break;
           // Not logged in
        case 419: 
              this.$router.push('/app/login') 
              break;// Session expired
        case 503: // Down for maintenance
            // Bounce the user to the login screen with a redirect back
            // window.location.reload();
              alert('Oops, 503 Maintenance in progress');
            break;
        case 500:
            alert('Oops, something went wrong!  The team have been notified.');
            break;
        default:
            // Allow individual requests to handle other errors
            return Promise.reject(error);
    }
});
export default {
    components:{
        'product-listing':ProductListing,
        'product-card':ProductCard,
        FontAwesomeIcon
        
          
    },
    name: 'App',
    created(){
      
      var token = localStorage.getItem('access_token');
      console.log('tesssss',token)
      if (typeof token == 'undefined' || token == null){
         if (window.location.pathname !== '/app/login') {
            window.location.replace('/app/login');
          }
      }else{
        if (window.location.pathname !== '/app/home') {
             this.$router.push('/app/home')
          }
       
      }
      if(this.$store.state.isAuthenticated==false ){
        this.$router.push('/app/login')
      }
      axios.get('/sanctum/csrf-cookie').then(response =>{
            this.getUser();
            this.getTest();
        })


    },
     computed: {
      cart () {
        return faShoppingCart
      },
      count () {
        return this.$store.state.totalItems
      },
      totalItemsCart(){
        console.log(this.$store.state.cart)
        let cart = this.$store.state.cart
        
        if(cart.length > 0){
          for(var i = 0;i<cart.length;i++)
          {
            totalItems+=(cart[i].qty);
          }
        }
        
        return totalItems;
      },
      calcTotalItem(){
        let total = this.$store.state.totalItems;
        this.cartItem.forEach((item, i) => {
            total +=  item.qty;
        });
        return this.total;
      },
      productCarts () {
        return this.$store.getters.cartTotals
      },
     },
    methods:{
        toggleOpen(){
          this.openUserMenu = !this.openUserMenu;
          console.log(this.openUserMenu)
        },
       getUser(){
            axios.get('/api/user').then(response=>{
                this.user = response.data;
                
            })
        },
        goToCart(){
          this.$router.push('/app/cart');
        },
        getTest(){
            axios.get('/api/test/create').then(response=>{
               console.log(response)
                
            })
        },
        getToken(){
            axios.post('/api/tokens/create',{
                token_name:"App Token"
            }).then(response =>{
                this.token = response.data.token;
                console.log(this.token);
            })
        },
        handleLogout() {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/logout')
            .then(response => {
                console.log(response.status)
                console.log('hello');
                if(response.status == 204){
                localStorage.clear()
                this.$store.commit(ISAUTHENTICATED, false)
                this.$router.push('/app/login') 

                }
            })
            .catch(error => {
                console.log('Error: ', error)
            })
        })
        },
    },

    data () {
    return {
      openUserMenu:false,
      total:0,
      myIcon: faSpinner,
      userIsAuthenticated : false,
      cartItem:this.$store.state.cart,
      totalItems:this.$store.state.totalItems

    }
  },
      mounted(){
    
    }
  

}
</script>

<style>
.loader {
	border-top-color: #3498db;
	-webkit-animation: spinner 1.5s linear infinite;
	animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
	0% {
		-webkit-transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(360deg);
	}
}

@keyframes spinner {
	0% {
		transform: rotate(0deg);
	}
	100% {
		transform: rotate(360deg);
	}
}

</style>
