import  Vue from  'vue';
import App from './Components/App.vue';
import  store from './store';
import {router} from './router';
new Vue({
    el:"#app",
    render:h=>h(App),
    components:{
        App
    },
    mounted:function () {
      M.AutoInit()
      this.$store.dispatch('getProducts')
    },
    template: '<App/>',
    data:{
        msg:"Vue"
    },
    router,
    store,


});