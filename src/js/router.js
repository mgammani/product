import  Vue from  'vue';
import VueRouter from 'vue-router';
import Dashboard from './Components/Dashboard.vue';
import ProductList from './Components/ProductList.vue';
import ProductBatches from  './Components/ProductBatches.vue';
import LoginComponent from './Components/LoginComponent.vue'
import beforeEnter from './auth'
import axios from "axios/index";


const router = new VueRouter({
    //mode: 'history',
    routes:[
        {
            path:'/product_batches',
            component:ProductBatches,
            beforeEnter,

        },
        {
            path:'/product_list',
            component:ProductList,
            beforeEnter,
        },
        {
            path:'/dashboard',
            component:Dashboard,
            beforeEnter,
        },
        {
            path:'/',
            component:LoginComponent,
            // beforeEnter(to,from,next){
            //     axios.get(url+'auth').then(res=>{
            //         if(res.data.status ==='authenticated')
            //             next(from);
            //         else
            //             next(false)
            //     });
            // }
        }
    ]
});

Vue.use(VueRouter);

export {router};
