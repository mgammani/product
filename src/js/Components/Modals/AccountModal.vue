<template>
    <div>
        <div id="account-modal" class="modal">
            <form v-on:submit.prevent="updateAccount($event)">
            <div class="modal-content">
                <div class="row">
                    <div class="col s11">
                        <h4>Change Password</h4>
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




                <success-alert message="Password updated successfully" ref="successAlert"></success-alert>
                <error-alert v-bind:message="errorMessage" ref="errorAlert"></error-alert>
                <div class="input-field">
                    <input  id="password" type="password" v-model="password" class="validate" required name="password">
                    <label for="password">Password</label>
                </div>
                <div class="input-field">
                    <input  id="confirm_password" v-model="confirm_password" type="password" class="validate" required>
                    <label for="confirm_password">Confirm Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button  class="modal-close waves-effect waves-green btn-flat">Cancel</button>
                <button type="submit" class="waves-effect waves-green btn-flat">Update</button>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ErrorAlert from '../Alerts/ErorrAlert.vue';
    import SuccessAlert from '../Alerts/SuccessAlert.vue';
    import axios from 'axios';
    export default {
        name: "AccountModal",
        components:{SuccessAlert,ErrorAlert},
        data(){
            return {
                password:'',
                confirm_password:'',
                errorMessage:'',
                loading:false
            }
        },
        methods:{
            updateAccount(event){
                if(this.password!==this.confirm_password){
                    this.errorMessage = "Password do not match";
                    this.$refs.errorAlert.showAlert()
                }else {
                    this.loading = true;
                    let passData= new FormData(event.target);
                    axios.post(url+'account/update',passData).then(res=>{
                        this.loading = false;
                        let resp = res.data;
                        if(resp.status === 'success'){
                            this.$refs.successAlert.showAlert()
                        }else{
                            this.errorMessage = "Password can not be updated at moment due to system error";
                            this.$refs.errorAlert.showAlert()
                        }
                    },()=>{
                        this.loading = false;
                        this.errorMessage = "Server error: Request can't be process ";
                        this.$refs.errorAlert.showAlert();
                    })
                }





            }
        }
    }
</script>

<style scoped>

</style>