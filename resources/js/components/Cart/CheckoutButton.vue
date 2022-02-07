<template>

    <a
         v-on:click.prevent="checkoutOrder"
      aria-label="checkout-products"
      class="border border-palette-primary text-palette-primary text-lg font-primary font-semibold pt-2 pb-1 leading-relaxed flex 
   justify-center items-center focus:ring-1 focus:ring-palette-light focus:outline-none w-full hover:bg-palette-lighter rounded-sm"
    >
    Check Out
     <font-awesome-icon :icon="faArrowRight" class="w-4 ml-2 inline-flex" />
      
      
    </a>

</template>

<script>
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
    // importando algumas mutations, para adicionar e remover do carrinho
    ISAUTHENTICATED,
    LOAD,
    CLEARCART
  } from '../../store/mutation-types'
import axios from 'axios'
export default {
    names:"checkout-btn",
    components:{FontAwesomeIcon},
    computed: {
        faArrowRight () {
        return faArrowRight
        },
    },
    methods:{
        checkoutOrder(){
            let config = {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                }
            }
           this.$store.commit(LOAD, true)
        axios.post('/api/order/create', this.$store.state.cart,config).then(response =>{
                 console.log(response);
               this.$store.commit(LOAD, false)
               this.$store.commit(CLEARCART,'');
                this.$router.push('/app/checkout')
        
        })
            
            
            
        }
    }
}
</script>

<style>

</style>