<template>
    <div id="edit-batch-modal" class="modal">
        <form v-on:submit.prevent="updateBatch($event)">
            <div class="modal-content">
                <div class="row">
                    <div class="col s11">
                        <h4>Edit Batch</h4>
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
                <success-alert message="Batch was successfully Updated"  ref="successAlert"></success-alert>
                <error-alert v-bind:message="errorMessage" ref="erorrAlert"></error-alert>
                <input type="hidden" name="id" v-model="batch.id"/>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="batch_name"  name="batch_name" type="text" v-model="batch.batch_name" class="validate"  required>
                        <label for="batch_name">Batch Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="created_by" name="created_by" v-model="batch.created_by" type="text" class="validate" required>
                        <label for="created_by">Created By</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
                <button type="submit" class=" waves-effect waves-green btn-flat">Update</button>
            </div>
        </form>
    </div>
</template>

<script>
    import SuccessAlert from './../Alerts/SuccessAlert.vue';
    import ErrorAlert from './../Alerts/ErorrAlert.vue';
    import axios from 'axios';
    import jquery from 'jquery';


    export default {
        name: "EditBatchComponent",
        components:{SuccessAlert,ErrorAlert},
        props:['batch'],
        data:()=>{
            return {
                loading:false,
                errorMessage:''
            }
        },
        watch:{
            batch:function (newVal,oldVal) {
               this.$nextTick(function () {
                   M.updateTextFields();
               })
            }
        },
        methods:{
            updateBatch (event) {
                let batchData  = new FormData(event.target);
                batchData.append('_method','PATCH');
                this.loading=true;
                axios.post(url+'/batch/'+this.batch.id,batchData).then((response)=>{
                    const data = response.data;
                    console.log(data)
                    this.loading = false;
                    if(data.status==='success'){
                        if(data.message === 'batch updated'){
                            this.$refs.successAlert.showAlert();
                            M.updateTextFields();
                        }
                    }else {
                        this.errorMessage = "Batch can not be Updated at the moment due to system error!!";
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

<style scoped>

</style>