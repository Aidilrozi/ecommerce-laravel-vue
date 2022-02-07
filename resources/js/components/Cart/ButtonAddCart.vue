<template>

  
    
  <div class="w-full md:w-2/3 px-2 mb-2 md:mb-0">
      <h4 class="mb-3 font-heading font-medium">Qty:</h4>
      <input v-model="cartProduct.qty" class="w-24 px-3 py-2 text-center bg-white border-2 border-purple-500 outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 rounded-xl" value="1" type="text" placeholder="1">
      
      <div class="block py-4 px-2 leading-8 font-heading font-medium tracking-tighter text-xl text-white text-center bg-purple-800 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 hover:bg-purple-600 rounded-xl my-8">
      <button   @click="addToCart"> Add to Cart</button>
      <!-- <button class="button button-danger" @click="removeFromCart(product.id)"><i class="fa fa-trash"></i> Remove from Cart</button> -->
      </div>
        <!-- <a class="block py-4 px-2 leading-8 font-heading font-medium tracking-tighter text-xl text-white text-center bg-purple-800 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 hover:bg-purple-600 rounded-xl" href="#">Add to bag</a> -->
  </div>
  
</template>

<script>
  import {
    ADD_TO_CART,
    REMOVE_FROM_CART
  } from '../../store/mutation-types'
export default {
    name:"button-add-cart",
    props: ['product'],
    data () {
      return {
        cartProduct: {
          qty:'',
          product_id:'',
          name:'',
          price:'',
        },
        productData : this.product,
      }
    },
    computed: {
      // verifica se o produto atual esta no carrinho
      isAdding () {
        // return this.cart.indexOf(this.product) < 0
      }
    },
    // aqui usamos as mutations
    methods: {
      addToCart () {
        console.log('clicked')
        this.cartProduct.product_id = this.productData.id;
        this.cartProduct.price = this.productData.productPrice * this.cartProduct.qty;
        this.cartProduct.name = this.productData.productName;
        this.$store.commit(ADD_TO_CART, this.cartProduct)
        console.log(this.$store.state.cart)
        // this.$router.push('/app/cart')
      },
      removeFromCart (id) {
        this.$store.commit(REMOVE_FROM_CART, id)
      }
    },
    updated(){
        console.log('Updated hook has been called');
    },
}
</script>

<style>

</style>