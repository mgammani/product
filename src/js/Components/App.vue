<template>
    <div>
        <header-component></header-component>
       <router-view></router-view>
    </div>
</template>

<script>
    import Dashboard from './Dashboard.vue';
    import  HeaderComponent from './HeaderComponent.vue';
    import Buttons from './Buttons.vue';
    import $ from 'jquery';


    export default {
        name: "App",
        data:()=>{
            return{
                msg:'msg'
            }
        },
        components:{
            Dashboard,HeaderComponent,Buttons
        },
        beforeCreate:function () {

        },
        mounted:function () {
            M.AutoInit();
            $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

        },


    }
</script>

<style scoped>

</style>