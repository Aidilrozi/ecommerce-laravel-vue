<template>

        
            <tr :key="product.id" class="text-sm sm:text-base text-gray-600 text-center">
              <td class="font-primary font-medium px-4 sm:px-6 py-4 flex items-center">
                <a class="pt-1 hover:text-palette-dark">
                    #2022-{{product.id}}
                  </a>
              </td>
              <td class="font-primary font-medium px-4 sm:px-6 py-4">
               <a class="pt-1 hover:text-palette-dark">
                    {{product.order_status}}
                  </a>
              </td>
              <td class="font-primary text-base font-light px-4 sm:px-6 py-4  sm:table-cell">
                {{product.payment_method}}
              </td>

            </tr>

     
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.withCredentials = true;
import { faTimes } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
export default {
    names:"history-table",
    props:["product"],
    components:{FontAwesomeIcon},
    computed: {
        fatimes () {
        return faTimes
        },
    }
}
</script>

<style>

</style>