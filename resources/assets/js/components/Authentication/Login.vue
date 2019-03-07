<template>
    <div class="wrapper">
        <div class="apex-panel">
            <div class="apex-brand"><h3>Apex MyERP</h3></div>
            <form @submit.prevent="loginUser">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email" required v-model="login.email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder=" Enter Password" required v-model="login.password">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <p class="apex-p">Coming here for the first time?
                <router-link to="/register">Register</router-link> now for Enterprise Solutions.
            </p>
        </div>
    </div>
</template>

<style scoped>
    .wrapper{
        width: 100%;
        height: 100vh;
        background: linear-gradient(#F8EFBA, #ff5252);
        position: relative;
    }

    .apex-panel{
        width: 500px;
        padding: 20px;
        position: absolute;
        border-radius: 10px;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        background-color: rgba(230, 230, 230, 0.3);
        box-shadow: 5px 5px 34px -1px rgba(44,58,71,1);
    }

    .apex-brand{
        padding-bottom: 10px;
    }

    .apex-p{
        width: 100%;
        padding: 15px 8px;
        text-align: center;
        color: #ffffff;
    }

    @media (max-width: 550px){
        .apex-panel{
            width: 350px;
            padding: 10px;
        }
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                login: {}
            }
        },
        methods: {
            loginUser(){
                axios.post('/login-user', this.login).then(response => {
                    this.login = '';
                    if(response.data == 1){
                        //this.$router.push({ path: "/home"});
                        window.location.href = '/dashboard';
                    } else {
                        this.$router.push({ path: "/register"});
                    }
                });
            }
        }
    }
</script>

