<template>
   <h1 class="leading-relaxed font-primary font-extrabold text-4xl text-center text-palette-primary mt-4 py-2 sm:py-4">
     {{textData}}
    </h1>
</template>

<script>
export default {
    name:'page-title',
    props:['text'],
    data () {
        return {
            textData: this.text, // you cannot use the same name as declared for props
        }
    }
}
</script>

<style>

</style>