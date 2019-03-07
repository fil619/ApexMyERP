<template>
    <div class="wrapper">
        <div class="apex-panel">
            <div class="apex-brand"><h3>Admin User Registration {{companyid}}</h3></div>
            <form @submit.prevent="addEmployee">
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" v-model="user.first_name">
                        <div v-if="errors && errors.first_name" class="text-danger">{{ errors.first_name[0] }}</div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" v-model="user.last_name">
                        <div v-if="errors && errors.last_name" class="text-danger">{{ errors.last_name[0] }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="firstName">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter Address" v-model="user.address">
                        <div v-if="errors && errors.address" class="text-danger">{{ errors.address[0] }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="firstName">Telephone</label>
                        <input type="text" class="form-control" id="telephone" placeholder="Enter Telephone" v-model="user.telephone">
                        <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="lastName">Mobile</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" v-model="user.mobile">
                        <div v-if="errors && errors.mobile" class="text-danger">{{ errors.mobile[0] }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="lastName">DOB</label>
                        <input type="date" class="form-control" id="dob" v-model="user.dob">
                        <div v-if="errors && errors.dob" class="text-danger">{{ errors.dob[0] }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="firstName">Type</label>
                        <input type="text" class="form-control" id="type" readonly v-model="user.type">
                        <div v-if="errors && errors.type" class="text-danger">{{ errors.type[0] }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="lastName">Joined On</label>
                        <input type="date" class="form-control" id="joined_on" v-model="user.joined_on">
                        <div v-if="errors && errors.joined_on" class="text-danger">{{ errors.joined_on[0] }}</div>
                    </div>
                </div>
                <div class="fom-row">
                    <div class="form-group col-sm-6">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="user.email">
                        <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" v-model="user.password">
                        <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
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
        width: 40%;
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

    @media (max-width: 1200px){
        .apex-panel{
            width: 60%;
            padding: 10px;
        }
    }

    @media (max-width: 650px){
        .apex-panel{
            width: 95%;
            padding: 10px;
        }
    }
</style>

<script>
    export default {
        props: ['companyid'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return{
                user: {
                    company_id : this.companyid,
                    type : 'Admin',
                },
                errors: {}
            }
        },
        methods: {
            addEmployee(){
                axios.post('/addEmployee', this.user).then(response => {
                    this.user = '';
                    console.log(response.data);
                    window.location.href = '/dashboard';
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    }
</script>

