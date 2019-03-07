<template>
  <v-app>
    <ol class="breadcrumb">
        <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Employee</a></li>
        <li class="active"><i class="fas fa-cash-register"></i>Edit</li>
    </ol>
        <v-dialog v-model="dialog" persistent max-width="500">
          <v-card>
            <v-card-title style="background-color:#0d47a1 ; color:white ; padding-top: 30px;">
              <i class="nav-icon fas fa-users fa-2x"></i>
              <span class="title font-weight-light">EDIT EMPLOYEE</span>
            </v-card-title>

            <v-card-text>
                     <v-form
                         ref="form"
                         v-model="valid"
                         lazy-validation
                       >
                       <v-text-field
                         v-model="editemployee.id"
                         :rules="[  v => !!v || 'Employee ID is required']"
                         label="Employee ID(*)"
                         required
                         disabled
                       ></v-text-field>

                       <v-layout row wrap>
                       <v-flex xs5 md5
                       <v-text-field
                         v-model="editemployee.first_name"
                         :rules="nameRules"
                         label="First Name(*)"
                         :counter="30"
                         required
                       ></v-text-field>
                      </v-flex>

                      <v-flex xs5 md5  offset-xs2 offset-md2>
                        <v-text-field
                          v-model="editemployee.last_name"
                          :rules="nameRules"
                          label="Last Name(*)"
                          :counter="30"
                          required
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                         <v-text-field
                           v-model="editemployee.dob"
                           type = "date"
                           :rules="[  v => !!v || 'Date of Birth is required']"
                           label="D.O.B(*)"
                           required
                         ></v-text-field>

                         <v-text-field
                           v-model="editemployee.address"
                           :rules="[  v => !!v || 'Address is required']"
                           label="Address(*)"
                           required
                         ></v-text-field>

                         <!-- <v-textarea
                         v-model="editemployee.address"
                          outline
                          :rules="[  v => !!v || 'Address is required']"
                        ></v-textarea> -->

                        <v-layout row wrap>
                           <v-flex xs5 md5 >
                         <v-text-field
                         v-model="editemployee.telephone"
                         type="number"
                         label="Telephone"
                         ></v-text-field>
                       </v-flex>
                       <v-flex xs5 md5 offset-md2 offset-xs2>
                         <v-text-field
                         v-model="editemployee.mobile"
                         type="number"
                         :rules="[  v => !!v || 'Phone Number is required']"
                         label="Phone Number(*)"
                         :counter="10"
                         required

                         ></v-text-field>
                       </v-flex>
                     </v-layout>

                         <v-text-field
                           v-model="editemployee.email"
                           :rules="emailRules"
                           label="E-mail"

                         ></v-text-field>

                         <v-text-field
                           v-model="editemployee.aadhaar"
                           label="Adhar Card Number"
                           :counter="12"
                         ></v-text-field>


                         <v-select
                           v-model="editemployee.type"
                           :items="type"
                           :rules="[v => !!v || 'Employee type is required']"
                           label="Employee type(*)"
                           required
                         ></v-select>

                         <v-text-field
                           v-model="editemployee.joined_on"
                           type = "date"
                           label="Joined On(*)"
                           :rules="[  v => !!v || 'Joining Date is required']"
                           required
                         ></v-text-field>
                         <v-layout row wrap>
                        <v-flex xs5 md5
                    
                       </v-flex>
                     </v-layout>
                         <v-btn
                           :disabled="!valid"
                           color="success"
                           @click="validate"
                         >
                           Update
                         </v-btn>

                         <v-btn
                           color="error"
                           @click="dialog = false"
                         >
                           Close
                         </v-btn>
                       </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- <v-btn color="green darken-1" flat @click="dialog = false">Disagree</v-btn>
              <v-btn color="green darken-1" flat @click="dialog = false">Agree</v-btn> -->
            </v-card-actions>
          </v-card>
        </v-dialog>

    <v-layout
      flex-child
      wrap
    >
      <v-flex
        xs12
        md8
        d-flex
      >
        <v-layout wrap>
          <v-flex xs12 md12>

            <div style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
            <i class="fas fa-th-list"></i> Employee Directory
            </div>

          </v-flex>

          <v-flex xs12 md12>
            <v-sheet
              class="d-flex"
              color="red lighten-3"
              min-height="455"
              xs12 md12
            >
            <v-card>
              <v-card-title>
                    Employee Directory
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      append-icon="search"
                      label="Search"
                      single-line
                      hide-details
                    ></v-text-field>
                  </v-card-title>

                <v-data-table
                  :headers="headers"
                  :items="employee"
                  :search="search"
                  :rows-per-page-items="[10,25]"
                >
                  <template slot="items" slot-scope="props" >
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.first_name }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.last_name }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.type }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.mobile }}</td>
                    <td class="justify-center layout px-0">
                      <v-icon small class="mr-2" @click="editItem(props.item)" slot="activator">edit</v-icon>
                    </td>
                  </template>
                  <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                  </v-alert>
                </v-data-table>
              </v-card>
            </v-sheet>
          </v-flex>

        </v-layout>
      </v-flex>

      <v-flex
        xs12
        md4
        color="#fafafa"
      >
      <v-sheet
        style="position: fixed ; width:100% ;min-height:100%"
        color="#fafafa"
              >
        <v-layout>
       <v-flex xs12 md12>
         <div class="rad-info-box rad-txt-success" style="height:90px">
                <i class="fa fa-users fa-4x" style="float:left;vertical-align: middle; padding-left:10px ;padding-right:10px ; padding-top:12px"></i>
                <span class="value title font-weight-medium" style=" padding-top:20px ; padding-right: 20px;"><span>{{clickedemployee.first_name}}</span></span>
                <span class="heading subheading font-weight-bold" style="padding-right: 20px;">{{clickedemployee.type}}</span>
        </div>
       </v-flex>
     </v-layout>

     <v-layout style="padding-left:30px">
       <v-flex xs12 md12 sm12>
         <strong> <center>Personal Information</center></strong><br>
         <strong>Full Name : </strong>{{clickedemployee.first_name}} {{clickedemployee.last_name}}<br>
         <strong>D.O.B : </strong>{{clickedemployee.dob}}<br>
         <strong>Address : </strong>{{clickedemployee.address}}<br>
         <strong>Adhar : </strong>{{clickedemployee.aadhaar}}<br>
       </v-flex>
     </v-layout>

     <v-layout style="padding-left:30px">
       <v-flex xs12 md12 sm12>
         <strong> <center>Contact Information</center></strong><br>
         <strong>Telephone Number : </strong>{{clickedemployee.telephone}}<br>
         <strong>Mobile Number : </strong>{{clickedemployee.mobile}}<br>
         <strong>Email : </strong>{{clickedemployee.email}}<br>
       </v-flex>
     </v-layout>

     <v-layout style="padding-left:30px">
       <v-flex xs12 md12 sm12>
         <strong> <center>Work Information</center></strong><br>
         <strong>Employee ID : </strong>{{clickedemployee.id}}<br>
         <strong>Company ID : </strong>{{clickedemployee.company_id}}<br>
         <strong>Department : </strong>{{clickedemployee.type}} <br>
         <strong>Joining Date : </strong>{{clickedemployee.joined_on}}<br>
       </v-flex>
     </v-layout>
   <!-- </v-container> -->
 </v-sheet>
      </v-flex>

    </v-layout>
  </v-app>
</template>

<script>
  export default {
    components: {
      SheetFooter: {
        functional: true,

        render (h, { children }) {
          return h('v-sheet', {
            staticClass: 'mt-auto align-center justify-center d-flex',
            props: {
              color: 'rgba(0, 0, 0, .36)',
              dark: true,
              height: 50
            }
          }, children)
        }
      }
    },
    mounted()
    {
      this.getemployees();
    },
    data () {
      return {
        selected:10,
        confirm: true,
        valid: true,
        password:'',
        confirmpassword:'',
        dialog: false,
        search: '',
        employee:[],
        clickedemployee:[],
        editemployee:[],
        headers: [
          { text: 'FirstName',     align: 'right',   value: 'first_name' },
          { text: 'Lastname',      align: 'right',   value: 'last_name' },
          { text: 'Department',    align: 'right',   value: 'type'},
          { text: 'Telephone No.', align: 'right',   value: 'mobile'},
          { text: 'Actions', value: 'actions', sortable: false }
        ],
        type: [
          'Staff',
          'Mechanic',
          'Admin'
        ],
        nameRules: [
          v => !!v || 'Name is required',
          v => (v && v.length <= 30) || 'Name must be less than 30 characters'
        ],
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+/.test(v) || 'E-mail must be valid'
        ],
      }
    },
    methods:{
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true

          axios.patch('/employee/update' + this.editemployee.id, {
            employee_id: this.editemployee.id,
            first_name: this.editemployee.first_name,
            last_name: this.editemployee.last_name,
            dob: this.editemployee.dob,
            address: this.editemployee.address,
            telephone: this.editemployee.telephone,
            mobile: this.editemployee.mobile,
            email: this.editemployee.email,
            aadhaar: this.editemployee.aadhaar,
            type: this.editemployee.type,
            password: this.editemployee.password,
            joined_on: this.editemployee.joined_on,
          })
              .then(response => {
                this.dialog = false
                this.getemployees();
        })

        }
      },
      reset () {
        this.$refs.form.reset()
      },
      getemployees()
      {
        axios.get('/employee').then(response => {
        this.employee = response.data.employee  ;
         })
      },
      empselected(employee)
      {
        this.clickedemployee = employee ;
      },
      editItem (item) {
        this.dialog = true
        this.editemployee = item ;
      }
    }
  }
</script>

<style scoped>
.rad-info-box {
  background:#fafafa !important;
}
.rad-txt-success {
    color: #23AE89;
}
.rad-info-box .heading {
    font-size: 1.2em;
    font-weight: 300;
    text-transform: uppercase;
}
.heading {
    padding-right: 20px;
    padding-top: 10px;
    display: block;
    position: relative;
    color: #515d6e;
    text-align: left;
    z-index: 10;
}
.rad-info-box .value, .rad-info-box .heading {
    text-transform: uppercase;
    display: block;
    padding-right: 10px;
    position: relative;
    color: #515d6e;
    text-align: left;
    z-index: 10;
}
</style>
