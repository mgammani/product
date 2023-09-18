import Vuex from 'vuex';
import Vue from 'vue';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        batches:[],
        products:[],
        totalBatches:0,
        totalProducts:0,
        totalExpiring:0,
        totalCost:0
    },
    mutations:{
        setProducts(state,products){
            state.products.length =0;
            state.products.push(...products);
        },
        setTotalProducts(state){
            state.totalProducts = state.products.length
        }
    },
    actions:{
        getProducts(context){
            axios.get(url+'products').then(response=>{
                context.commit('setProducts',response.data);
            })
        },
        getBatches(context){

        }
    }
})
