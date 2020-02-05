<template>
    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('assets/img/auth/login-bg.jpg')">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="javascript:void(9)">TK</a>
                        </div>
                        <h3>Sign In to Taskola</h3>
                        <p>Happy to see you again!</p>
                        <validation-errors :myErrors="validationErrors" v-if="validationErrors"></validation-errors>
                            <div class="form-group">

                                <input v-validate="'required|email'" name="email" type="email" class="form-control" :class="{'input': true, 'is-invalid': errors.has('email') }" v-model="email" placeholder="Email" autofocus>
                                <i class="ik ik-user"></i>
                                <div class="heightError invalid-feedback" v-show="errors.has('email')">{{ errors.first('email') }}</div>
                            </div>
                            <div class="form-group">
                                <input type="password" :class="{'input': true, 'is-invalid': errors.has('password') }" class="form-control" @keyup.enter="login()" v-model="password" placeholder="Password" v-validate="'required|min:8'" name="password">
                                <i class="ik ik-lock"></i>
                               <div class="heightError invalid-feedback" v-show="errors.has('password')">{{ errors.first('password') }}</div>
                            </div>
                            <div class="row">
                                <div class="col text-left">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="item_checkbox" name="remember" value="option1">
                                        <span class="custom-control-label">&nbsp;Remember Me</span>
                                    </label>
                                </div>
                                <div class="col text-right">
                                    <a href="password.request">Forgot Password ?</a>
                                </div>
                            </div>
                            <div class="sign-btn text-center">
                                <button class="btn btn-theme" 
		                            @click.prevent="login()"
                                >Sign In</button>
                            </div>
                        <div class="register">
                            <p>Don't have an account? <a href="register">Create an account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                email:'',
                password:'',
                validationErrors: ''
            }
        },
        mounted() {
        },
        methods:{
            login(){

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/login',{
                        email: this.email,
                        password: this.password
                        }).then(response => {
                            window.location = '/dashboard'
                        }).catch(errors => {
                            if (errors.response.status == 422){
                               this.validationErrors = errors.response.data.errors;
                              }
                        });
                    }
                });
            }
        }
    }
</script>
