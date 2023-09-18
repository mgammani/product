<template>
    <div>
        <div class="buttons ">
            <div class="container">
                <div class="row">
                    <div class="col s6 m2 lg2">
                        <router-link  to="/dashboard"  class="waves-effect waves-light btn red lighten-2">Dashboard</router-link>
                    </div>

                    <div class="col s6 m2 lg3">
                        <router-link  to="/product_batches"  class="waves-effect waves-light btn red lighten-2">Batches</router-link>
                    </div>
                    <div class="col s6  m2 lg3">
                        <router-link to="/product_list" class="waves-effect waves-light btn red lighten-2">Product List</router-link>
                    </div>

                    <div class="col s4 m2 lg3">
                        <button class="waves-effect waves-light btn  modal-trigger" data-target="batch-modal">New Batch</button>
                    </div>
                    <div class="col m2 s6 lg3">
                        <button class="waves-effect waves-light btn modal-trigger" data-target="product-modal">New Product</button>
                    </div>
                    <div class="col m1 s6 lg1">
                        <button class="waves-effect waves-light btn dropdown-trigger" data-target='dropdown1'>Account</button>

                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="#" class="modal-trigger" data-target="account-modal">Change Password</a></li>
                            <li><a href="#" v-on:click.prevent="logout">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
        <add-product-component></add-product-component>
        <add-batch-component></add-batch-component>
        <account-modal></account-modal>
    </div>
</template>

<script>
    import AddProductComponent from './Modals/AddProductComponent.vue';
    import AddBatchComponent from './Modals/AddBatchComponent.vue';
    import AccountModal from './Modals/AccountModal.vue';
    import axios from 'axios';
    export default {
        name: "Buttons",
        components:{AddProductComponent,AddBatchComponent,AccountModal},
        mounted:function (){
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
            M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'));
        },
        methods:{
            logout(){
                axios.post(url+'logout').then(res=>{
                    this.$router.push({path:'/'})
                })
            }
        }
    }
</script>

<style scoped>

</style>