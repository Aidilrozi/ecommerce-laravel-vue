<template>
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-12 w-auto" src="/images/icon.svg" alt="Workflow">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
      <p class="mt-2 text-center text-sm text-gray-600">

      </p>
    </div>
    <div v-if="isLogin">
        <form class="mt-8 space-y-6" v-on:submit.prevent="submitForm">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" v-model="form.email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" v-model="form.password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
            </div>
            
            
            </div>

            <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox"  v-model="form.rememberMe" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
            </div>

            <div class="text-sm">
                <a href="#" class="font-medium text-indigo-600 hover:text-purple-500"> Forgot your password? </a>
            </div>
            </div>

            <div>
            <button  @click="handleLogin" class="bg-purple-800 button group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <!-- Heroicon name: solid/lock-closed -->
                <svg class="h-5 w-5 text-purple-500 group-hover:text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                </span>
                Sign in
            </button>
                <button  @click="toggleForm" class="bg-purple-800 button group relative w-full flex justify-center py-2 px-4 my-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <!-- Heroicon name: solid/lock-closed -->
                <svg class="h-5 w-5 text-purple-500 group-hover:text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                </span>
                Register
            </button>
                
            </div>
        </form>
    </div>
    <div v-else>
        <form class="mt-8 space-y-6" v-on:submit.prevent="submitForm">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" v-model="formRegister.email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
            </div>
                <div>
                <label for="name" class="sr-only">Name</label>
                <input id="name" v-model="formRegister.name" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Name">
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" v-model="formRegister.password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
            </div>
            <div>
                <label for="password-confirmation" class="sr-only">Password Confirmation</label>
                <input id="password-confirmation" name="password_confirmation" v-model="formRegister.passwordConfirmation" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password Confirmation">
            </div>
            
            </div>

             <div class="flex items-center justify-between">
      

            <div class="text-sm">
                <a v-on:click.prevent="toggleForm" class="font-medium text-indigo-600 hover:text-purple-500"> Click to Login </a>
            </div>
            </div>

            <div>
                <button  v-on:click.prevent="handleRegister" class="bg-purple-800 button group relative w-full flex justify-center py-2 px-4 my-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <!-- Heroicon name: solid/lock-closed -->
                <svg class="h-5 w-5 text-purple-500 group-hover:text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                </span>
                Register
            </button>
                
            </div>
        </form>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.withCredentials = true;
import {
    // importando algumas mutations, para adicionar e remover do carrinho
    ISAUTHENTICATED,
    LOAD
  } from '../../store/mutation-types'
export default {
    name:"login",
    created(){
        
        axios.get('/sanctum/csrf-cookie').then(response =>{
            this.getUser();
        })
    },
    data() {
        return {
            isLogin:true,
            user:null,
            form:{
                email:'',
                password:'',
                rememberMe:'',
            },
             formRegister:{
                name:'',
                email:'',
                password:'',
                passwordConfirmation:'',
               
            },
            register:{
                email:'test@test.com',
                password:'1qaz2wsx3edc',
                password_confirmation:'1qaz2wsx3edc',
                name:'testing'
            },
            token:'',
            userIsAuthenticated : this.$store.state.isAuthenticated
        }
    },
    methods: {
        getUser(){
            axios.get('/api/user').then(response=>{
                this.user = response.data;
            })
        },
        handleLogin() {
        this.$store.commit(LOAD, true)
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/login', this.form)
            .then(response => {
                console.log(response.status)
                console.log('hello');
                if(response.status == 200){
                this.$store.commit(ISAUTHENTICATED, true)
                this.$store.commit(LOAD, false)
                this.$router.push('/app/home') 
                this.getToken();
                }
            })
            .catch(error => {
                console.log('Error: ', error)
            })
        })
        },
        handleRegister() {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/register', this.register)
            .then(response => {
                console.log(response)
                this.$router.push('/app/home') 

            })
            .catch(error => {
                console.log('Error: ', error)
            })
        })
        },
        getToken(){
            axios.post('/api/tokens/create',{
                token_name:"App Token"
            }).then(response =>{
                this.token = response.data.token;
                localStorage.setItem('access_token', response.data.token);
            })
        },
        toggleForm(){
            this.isLogin = !this.isLogin;
        }
    },

}
</script>

<style>

</style>