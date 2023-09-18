<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col m6 offset-m3">
                    <div class="form white">
                        <h4>Login</h4>
                        <hr>
                        <error-alert message="Invalid username or password" ref="errorAlert"></error-alert>
                        <form method="post" v-on:submit.prevent="login($event)">
                            <div class="input-field">
                                <input  id="first_name" type="text" name="username" class="validate" required>
                                <label for="first_name">Username</label>
                            </div>
                            <div class="input-field">
                                <input id="last_name" type="password"  name="password" class="validate" required>
                                <label for="last_name">Password</label>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ErrorAlert from './Alerts/ErorrAlert.vue'
    export default {
        name: "LoginComponent",
        components:{ErrorAlert},
        methods:{
            login(event){
                let loginData = new FormData(event.target);
                axios.post(url+'login',loginData).then(res=>{
                  if(res.data.status ==='success'){
                      this.$router.push({path:'dashboard'})
                  }else{
                      this.$refs.errorAlert.showAlert();
                  }

                });
            }
        }
    }
</script>

<style scoped lang="scss">
    .form{
        padding: 20px;
        margin-top: 10%;
    }
</style>