<template>
    <div>
        <buttons></buttons>
        <table-component table-title="Product List" v-bind:products="sortedProducts"></table-component>
    </div>
</template>

<script>
    import TableComponent from './Tables/ProductTable.vue';
    import Buttons from './Buttons.vue';
    import axios from 'axios';
    export default {
        name: "ProductList",
        data(){
            return{
                products:[]
            }
        },
        computed:{
            sortedProducts(){return this.products.reverse()},
        },
        components:{
            Buttons,
            TableComponent
        },
        mounted:function () {
         M.FormSelect.init(document.querySelectorAll('select'));
            this.products=this.$store.state.products;

        },
        methods:{
            getProducts(){
                this.$store.dispatch('getProducts');
            },



        },
        created(){

        },
    }
</script>

<style scoped>

</style>