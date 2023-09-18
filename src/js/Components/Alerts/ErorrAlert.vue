<template>
    <transition name="fade">
        <div class="" v-if="show">
            <div class="row  red lighten-2 alert">
                <div class="col s11">
                    <p>{{ message }}</p>
                </div>
                <div class="col s1">
                    <button type="button"><span class="fa fa-close" @click="show=false"></span></button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "ErorrAlert",
        data:function () {
            return{
                show:false
            }
        },
        props:['message'],
        methods:{
            showAlert:function () {
                this.show  = true;
                window.setTimeout(()=>{this.show =false },1800)
            }
        },
    }
</script>

<style scoped lang="scss">
    .alert{
        padding: 15px;
    button,p{
        background: transparent;
        border: none;
        color:darken(#b71c1c,20%);
    }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>