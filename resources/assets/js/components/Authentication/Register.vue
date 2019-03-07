<template>
    <div class="wrapper">
        <div class="apex-panel">
            <div class="apex-brand"><h3>Register Your Enterprise</h3></div>
            <form @submit.prevent="addCompany">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Enter Company Name" v-model="company.name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="companyDesc">Company Description</label>
                        <input type="text" class="form-control" id="companyDesc" placeholder="Enter Company Description" v-model="company.description">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="companyAddress">Company Address</label>
                        <input type="text" class="form-control" id="companyAddress" placeholder="Enter Company Address" v-model="company.address">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="companyTelephone">Company Telephone</label>
                        <input type="text" class="form-control" id="companyTelephone" placeholder="Enter Company Telephone" v-model="company.telephone">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="companyMobile">Company Mobile</label>
                        <input type="text" class="form-control" id="companyMobile" placeholder="Enter Company Mobile" v-model="company.mobile">
                    </div>
                </div>
                <div class="from-row">
                    <div class="form-group col-sm-12">
                        <label for="companyGST">Company GST No</label>
                        <input type="text" class="form-control" id="companyGST" placeholder="Enter Company GST no" v-model="company.gst_no">
                    </div>
                </div>
                <div class="from-row">
                    <div class="form-group col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
            <p class="apex-p">Already Registered?
                <router-link to="/login">Login</router-link> to continue working.
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
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return{
                company: {}
            }
        },
        methods: {
            addCompany(){
                axios.post('/addCompany', this.company).then( response => {
                    this.company = '';
                    this.$router.push({ name: 'registerAdmin', params: {companyid : response.data}});
                });
            }
        }
    }
</script>

