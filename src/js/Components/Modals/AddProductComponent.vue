<template>
    <div id="product-modal" class="modal modal-fixed-footer">
        <form v-on:submit.prevent="addProduct($event)">
            <div class="modal-content">
                <div class="row">
                    <div class="col s11">
                        <h4>Add New Product</h4>
                    </div>
                    <div class="col s1">
                        <div class="preloader-wrapper small active" v-if="loading">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <success-alert message="Product was successfully added"  ref="alert"></success-alert>
                <error-alert v-bind:message="errorMessage" ref="erorrAlert"></error-alert>
                <div class="row">
                    <div class="input-field col s12 m6 ">
                        <select id="batch_id" name="batch_id" class="validate" v-model="product.batch" required>
                            <option value="" disabled selected>Select Batch</option>
                            <option v-for="batch in batches" :value="batch.id">{{ batch.batch_name}}</option>
                        </select>
                        <label for="batch_id" data-error="Select a batch">Product Batch</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="product_name" type="text" name="product_name" class="validate" v-model="product.name" required>
                        <label for="product_name">Product Name</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <input id="manufacturer" type="text" class="validate" name="manufacturer" v-model="product.manufacturer" required>
                        <label for="manufacturer">Manufacturer Name</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <input id="bar_code" type="text" class="validate" name="barcode" v-model="product.barcode" required>
                        <label for="bar_code">Barcode</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="quantity" type="number" class="validate" name="quantity" v-model="product.quantity" required>
                        <label for="quantity">Quantity</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="price" type="number" name="price" class="validate" v-model="product.price" required>
                        <label for="price">Price</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="man_date" type="date" name="manufacturing_date" class="validate" v-model="product.manufacturingDate" required>
                        <label for="man_date">Manufacturing Date</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="expiry_date" type="date" name="expiry_date" class="validate" v-model="product.expiryDate" required>
                        <label for="expiry_date">Expiry Date</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
                <button type="submit" class=" waves-effect waves-green btn-flat">Add</button>
            </div>
        </form>
    </div>
</template>

<script>
    import SuccessAlert from './../Alerts/SuccessAlert.vue';
    import ErrorAlert from './../Alerts/ErorrAlert.vue';
    import axios from 'axios';

    export default {
        name: "AddProductComponent",
        data:function () {
          return  {
                product:{
                    batch:'',
                    name:'',
                    manufacturer:'',
                    barcode:'',
                    quantity:'',
                    price:'',
                    manufacturingDate:'',
                    expiryDate:'',
                },
              loading:false,
              errorMessage:'',
              batches:[]
            }
        },
        components:{SuccessAlert,ErrorAlert},
        methods:{

            /**
             * Stores product to the database
             * @param event
             */

            addProduct:function(event){
                let productData  = new FormData(event.target);
                this.loading=true;
                axios.post(url+'product',productData).then((response)=>{
                    const data = response.data;
                    this.loading = false;
                    if(data.status==='success'){
                        if(data.message === 'product added'){
                            this.$refs.alert.showAlert();
                            this.product.name = '';
                            this.product.manufacturer = '';
                            this.product.barcode = '';
                            this.product.quantity = '';
                            this.product.price = '';
                            this.product.manufacturingDate = '';
                            this.product.expiryDate = '';
                            this.$store.dispatch('getProducts');
                        }
                    }else {

                        console.log(data)
                        this.errorMessage = "Product can not be added at the moment due to system error!!";
                        this.$refs.erorrAlert.showAlert();
                    }
                },(response)=>{


                    this.loading=false;
                    this.errorMessage = "Server error: Request can't be process ";
                    this.$refs.erorrAlert.showAlert();
            })},

            /**
             * get a list of product batches and populate the select batch
             * element
             */
            populateBatches:function(){
                let self = this;
                axios.get(url+'batches').then(res=>{
                    res.data.forEach(obj=>{
                        this.batches.push(obj);
                    });

                    this.$nextTick(function () {
                       M.FormSelect.init(document.querySelector('#batch_id'));
                    })
                })
            },

        },


        created:function () {
            this.populateBatches();
        },
        mounted:function () {
        }
    }
</script>

<style scoped>

</style>