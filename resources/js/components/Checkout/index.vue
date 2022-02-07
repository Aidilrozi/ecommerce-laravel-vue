<template>
   <div class="container mx-auto mb-20 min-h-screen">
       <!-- page title -->
       <!-- cart table -->
       <page-title/>
       <!-- <cart-table/> -->
    <div class="min-h-80 max-w-2xl my-4 sm:my-8 mx-auto w-full">
      <table class="mx-auto">
        <thead>
          <tr class="uppercase text-xs sm:text-sm text-palette-primary border-b border-palette-light">
            <th class="font-primary font-normal px-6 py-4">Order ID</th>
            <th class="font-primary font-normal px-6 py-4">Order Status</th>
            <th class="font-primary font-normal px-6 py-4 hidden sm:table-cell">Payment Status</th>
      
          </tr>
        </thead>
        <tbody class="divide-y divide-palette-lighter">
                <template v-for="product in products">
                <history-table :product="product" :key="product.id"></history-table>
                </template>
               
       
          
        </tbody>
         </table>
    </div>
         <div class="max-w-sm mx-auto space-y-4 px-2">
             <!-- checkout button -->
           
         </div>
   </div>
</template>


<script>
import PageTitle from '../../PageTitle.vue'

import HistoryTable from './HistoryTable.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.withCredentials = true;

export default {
    name:"checkout",
    components :{HistoryTable,PageTitle},
  created(){
   this.getProducts()
  },

    computed: {
      counter: function() {
      return this.$store.getters.counter
    },

  },
  data () {
    return {
      products:[]
    }},
  methods: {
      getProducts(){
          let config = {
              headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
              }
          }
          
              
          axios.get('/api/order/list',config).then(response =>{
              console.log(response);
             return this.products = response.data;
      
          })
            
        },
      orderList(){
          let config = {
              headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
              }
          }
          
              
          axios.post('/api/order/list', this.$store.state.cart,config).then(response =>{
              console.log(response);
      
          })
            
        },
    increment: function () {
      this.$store.commit('increment')
    },
    decrement: function () {
      this.$store.commit('decrement')
    }
  }
}
</script>

<style>


</style>