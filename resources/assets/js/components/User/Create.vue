<template>
<v-app>
  <ol class="breadcrumb">
      <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Employee</a></li>
      <li class="active"><i class="fas fa-cash-register"></i>Create</li>
  </ol>
  <div>
 <div style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
 <i class="fas fa-user-plus"></i> Add Employee
</div>
  <!-- <v-divider></v-divider> -->
  <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-container fluid>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md4
          >
          <v-text-field
            v-model="firstname"
            :rules="nameRules"
            label="First Name(*)"
            :counter="30"
            required
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="lastname"
            :rules="nameRules"
            label="Last Name(*)"
            :counter="30"
            required
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="dob"
            type = "date"
            :rules="[  v => !!v || 'Date of Birth is required']"
            label="D.O.B(*)"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md4
          >
          <v-text-field
          v-model="telephone"
          type="number"
          label="Telephone"
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
          v-model="phone"
          type="number"
          :rules="[  v => !!v || 'Phone Number is required', v => (v && v.length <= 10) || 'Phone Number must be less than 10 digits']"
          label="Phone Number(*)"
          :counter="10"
          required

          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
             ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md10
          >
            <v-text-field
              v-model="address"
              :counter="10"
              label="Address"
              :rules="[  v => !!v || 'Address is required']"
              required
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md4
          >
          <v-text-field
            v-model="aadhaar"
            label="Adhar Card Number"
            mask="NNNN-NNNN-NNNN"
            :counter="12"
          ></v-text-field>
          </v-flex>
          <v-flex
            xs12
            md3
          >
          <v-select
            @change="onChange($event)"
            v-model="select"
            :items="type"
            :rules="[v => !!v || 'Employee type is required']"
            label="Employee type(*)"
            required
          ></v-select>
          </v-flex>
          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="joined"
            type = "date"
            label="Joined On(*)"
            :rules="[  v => !!v || 'Joining Date is required']"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap v-if="setpwd">
          <v-flex
            xs12
            md5
          >
          <v-text-field
            v-model="password"
            label="Password(*)"
            type="password"
            :rules="[  v => !!v || 'Password is required']"
            required
          ></v-text-field>
          </v-flex>
          <v-flex
            xs12
            md5
          >
          <v-text-field
            v-model="confirmpwd"
            label="Confirm Password(*)"
            type="password"
            :rules="[  v => (!!v && v) === this.password || 'Password do not match']"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout  row wrap justify-center>
        <v-flex xs12 sm6 md9 class="text-xs-center">
              <v-btn
                color="success"
                @click="validate"
              >
                Generate
              </v-btn>
              <v-btn
              color="error"
              @click="reset"
              >
              Reset Form
            </v-btn>
        </v-flex>

      </v-layout>
      </v-container>
    </v-form>

</div>
</v-app>
</template>

<script>
import Vue from 'vue';
import Vuetify from 'vuetify';
Vue.use(Vuetify, {
  iconfont: 'md'
})
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';

export default {
  mounted()
  {

  },
    data: () => ({
      valid: true,
      firstname:'',
      lastname:'',
      dob:'',
      address:'',
      telephone:'',
      phone:'',
      email:'',
      aadhaar:'',
      select:'',
      joined:'',
      password:'',
      confirmpwd:'',
      setpwd:false,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 30) || 'Name must be less than 30 characters'
      ],
      email: '',
      emailRules: [
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      select: null,
      type: [
        'Staff',
        'Mechanic',
        'Admin'
      ],
    }),

    methods: {
      onChange(event){
         if (event == 'Admin') {
           this.setpwd = true;
         }
         else {
           this.setpwd = false;
         }
      },
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
            axios.post('/employee', {
            first_name: this.firstname,
            last_name:this.lastname,
            dob:this.dob,
            address:this.address,
            telephone:this.telephone,
            mobile:this.phone,
            email:this.email,
            aadhaar:this.aadhaar,
            type:this.select,
            joined_on:this.joined,
            password:this.password,
            status:'Not Available',
          })
              .then(response => {
                this.$refs.form.reset()
              })
        }
      },
      reset () {
        this.$refs.form.reset()
      },
    }
  }
</script>

<style scoped>
.v-form>.container>.layout>.flex {
  padding: 0px 8px 0px 0px;
}
.application--wrap {
  min-height: 10vh;
}
</style>
