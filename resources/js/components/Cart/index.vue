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
            <th class="font-primary font-normal px-6 py-4">Product</th>
            <th class="font-primary font-normal px-6 py-4">Quantity</th>
            <th class="font-primary font-normal px-6 py-4 hidden sm:table-cell">Price</th>
            <th class="font-primary font-normal px-6 py-4">Remove</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-palette-lighter">
                <template v-for="product in cart">
                <cart-table :product="product" :key="product.id"></cart-table>
                </template>
               
              <!-- <tr class="text-center">
                <td></td>
                <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">Subtotal</td>
                <td class="font-primary text-lg text-palette-primary font-medium px-4 sm:px-6 py-4">
                 RM<span class="text-xl">50</span>
                </td>
                <td></td>
              </tr> -->
          
        </tbody>
         </table>
    </div>
         <div class="max-w-sm mx-auto space-y-4 px-2">
             <!-- checkout button -->
             <checkout-btn></checkout-btn>
             <!-- back to product list -->
             <back-to-product></back-to-product>
         </div>
   </div>
</template>

<script>
import PageTitle from '../../PageTitle.vue'
import BackToProduct from './BackToProduct.vue'
import CartTable from './CartTable.vue'
import CheckoutButton from './CheckoutButton.vue'

export default {
    name:"cart",
    components :{CartTable, PageTitle,"checkout-btn":CheckoutButton, BackToProduct},
    data () {
      return {
        cart: this.$store.state.cart
      }
    },
}
</script>


<style>

</style>