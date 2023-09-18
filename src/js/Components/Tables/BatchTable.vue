<template>

    <div>
        <div class="table">
            <div class="container">
                <div class="z-depth-1 white t-wrapper">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="title">
                                <h5>List of Product Batches</h5>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <!--<div class="input-field">-->
                            <!--<select id="batch">-->
                            <!--<option value="" disabled selected>Select Batch</option>-->
                            <!--</select>-->
                            <!--<label for="batch">Product Batch</label>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <error-alert v-bind:message="errorMsg" ref="errorAlert"></error-alert>
                    <success-alert v-bind:message="successMsg" ref="successAlert"></success-alert>
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Batch Name</th>
                            <th>Created By</th>
                            <th>Created On</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody name="table-row" is="transition-group" >
                        <tr  v-for="(batch,index) in batches" :key="batch.id">
                            <td>{{ index+1}}</td>
                            <td>{{ batch.batch_name }}</td>
                            <td>{{ batch.created_by}}</td>
                            <td>{{ batch.created_at}}</td>
                            <td><button @click="editBatch(batch)" class="btn waves-circle fa fa-pencil"></button></td>
                            <td><button @click="deleteBatch(batch,index)" class="btn waves-circle red fa fa-trash"></button></td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <edit-batch-component v-bind:batch="currentBatch"></edit-batch-component>
    </div>
</template>

<script>
    import axios from 'axios';
    import ErrorAlert from '../Alerts/ErorrAlert.vue';
    import SuccessAlert from '../Alerts/SuccessAlert.vue';
    import EditBatchComponent from '../Modals/EditBatchComponent.vue';
    import jquery from 'jquery';
    export default {
        name: "BatchTable",
        components:{ErrorAlert,SuccessAlert,EditBatchComponent},
        data:function () {
            return {
                batch:{},
                batches:[],
                errorMsg:'',
                successMsg:'',
                currentBatch:{}
            }
        },
        methods:{
            getBatches() {
                axios.get(url+'batches').then(response=>{
                        this.batches = response.data;
                    },
                    ()=>{})
            },

            deleteBatch(batch,index) {
                let ans = confirm("Are you sure you want to delete this batch?, all products in this batch will be deleted")
                if(ans){
                    // this.batches.splice(index,1);
                    axios.delete(url+'batch/'+batch.id).then((response)=>
                        {
                            const msg = response.data;
                           if(msg.status ==='success'){
                               this.successMsg = "Batch successfully deleted";
                               this.$refs.successAlert.showAlert();
                               this.getBatches();
                           }else {
                               this.errorMsg = "Batch was not deleted due to system error";
                               this.errorAlert.showAlert();
                           }

                        },
                        // Promise then callback
                        ()=>{
                            this.errorMsg= "Server error: Request can't be process ";
                            this.$refs.errorAlert.showAlert();
                        })
                }
            },
            editBatch(batch) {
                this.currentBatch =batch;
              let modal =  M.Modal.getInstance(document.getElementById('edit-batch-modal'));
              modal.options.onCloseStart = ()=>{
                 this.getBatches();
              };
              modal.open();
            }
        },
        created:function () {
            this.getBatches();
        }
    }
</script>

<style scoped lang="scss">
    .table-row-move {
        transition: all 10.9s;
    }
    .table-row-item {
        backface-visibility: hidden;
    }
</style>