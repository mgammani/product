<template>
    <div id="batch-modal" class="modal">
        <form v-on:submit.prevent="addBatch($event)">
            <div class="modal-content">
                <div class="row">
                    <div class="col s11">
                        <h4>Add New Product Batch</h4>
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
                <success-alert message="Batch was successfully added"  ref="alert"></success-alert>
                <error-alert v-bind:message="errorMessage" ref="erorrAlert"></error-alert>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="batch_name"  name="batch_name" type="text" class="validate" v-model="batch.name" required>
                        <label for="batch_name">Batch Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="created_by" name="created_by" type="text" class="validate" v-model="batch.createdBy" required>
                        <label for="created_by">Created By</label>
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
        name: "AddBatchComponent",
        components:{SuccessAlert,ErrorAlert},
        data:()=>{
            return {
                batch:{
                    id:'',
                    name:'',
                    createdBy:''
                },
                loading:false,
                errorMessage:''
            }
        },
        methods:{
            addBatch:function (event) {
                let batchData  = new FormData(event.target);
                this.loading=true;
                axios.post(url+'/batch',batchData).then((response)=>{
                    const data = response.data;
                    this.loading = false;
                    if(data.status==='success'){
                        if(data.message === 'batch added'){
                            this.$refs.alert.showAlert();
                            this.batch.name = '';
                            this.batch.createdBy='';
                            M.updateTextFields();
                        }
                    }else {
                        this.errorMessage = "Batch can not be added at the moment due to system error!!";
                        this.$refs.erorrAlert.showAlert()
                    }
                }).catch( ()=> {
                    this.loading=false;
                    this.errorMessage = "Server error: Request can't be process ";
                    this.$refs.erorrAlert.showAlert()
                })
            }
        }
    }
</script>

<style scoped lang="scss">

</style>