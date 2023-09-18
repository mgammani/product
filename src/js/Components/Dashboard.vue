<template>
    <div>
        <buttons></buttons>
        <summary-component></summary-component>
        <table-component table-title="Products Expiring soon" v-bind:products="products"></table-component>
    </div>
</template>

<script>
    import  SummaryComponent from './SummaryComponent.vue';
    import TableComponent from './Tables/ProductTable.vue';
    import Buttons from './Buttons.vue';
    export default {
        name: "DashBoard",
        components:{
           SummaryComponent,TableComponent,Buttons
        },
        data(){
            return{
                products:[]
            }
        },
        mounted:function () {
            M.FormSelect.init(document.querySelectorAll('select'));
            this.products = this.$store.state.products;
        }
    }

</script>

<style scoped>

</style>