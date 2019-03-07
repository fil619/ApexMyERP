<template>
<v-app>
  <ol class="breadcrumb" >
      <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Employee</a></li>
      <li class="active"><i class="fas fa-cash-register"></i>Attendance</li>
  </ol>
    <v-dialog v-model="dialog" scrollable max-width="955px" >
      <v-card style="padding-top:10px ; padding-left:50px">
        <v-card-title>
<div class="font-weight-black">
  Attendance Report for {{ selected.first_name}} {{selected.last_name}} from {{startdate }} to {{ enddate}}
</div>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="height: 500px">
          <v-data-table
              :headers="modalheaders"
              :items="reportview"
              class="elevation-1"
              :rows-per-page-items="[100]"
            >
              <template v-slot:items="props">
                <td>{{ props.item.date }}</td>
                <td class="text-xs-right">{{ props.item.checkin }}</td>
                <td class="text-xs-right">{{ props.item.checkout }}</td>
                <td class="text-xs-right">{{ props.item.working_hours }}</td>
                <td class="text-xs-right">{{ props.item.status }}</td>
                <td class="text-xs-right">{{ props.item.daystatus }}</td>
              </template>
            </v-data-table>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn class="no-print" color="blue darken-1" flat @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- <v-container fluid> -->
    <v-layout row wrap>
      <v-flex xs12 md7 style="padding-left:15px">
        <v-card  tile flat>
          <v-card-text>
            <v-layout
              flex-child
              wrap
              class="no-print"
            >
            <v-flex xs12 md12 >

              <div style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
              <i class="fas fa-calendar-alt"></i> Attendance Report
              </div>
            </v-flex>
              <v-flex
                xs12
                md4
                d-flex
                style="padding-right:5px ; padding-top:5px"
              >
                <v-sheet
                :elevation="10"
                  class="d-flex"
                  color=" white lighten-3"
                  height="80"

                >
                <p class="text-lg-left font-weight-black"  style="padding:10px ; color:black" >Total : {{count}}</p>
                <v-flex xs5  sm5 md5>
                  <v-sheet
                    class="d-flex"
                    color="blue darken-1 lighten-3"
                    height="80"

                  >
                  <p class="text-lg-center"  style="padding:10px" ><i class="fa fa-users" style="font-size:50px;color:#0d47a1 "></i></p>

                  </v-sheet>
                </v-flex>
                </v-sheet>
              </v-flex>
              <v-flex
                xs12
                md4
                d-flex
                style="padding-right:5px ; padding-top:5px"
              >

                <v-sheet
                :elevation="10"
                  class="d-flex"
                  color="  white lighten-3"
                  height="80"

                >
                <p class="text-lg-left font-weight-black"  style="padding:10px ; color:black" >Present : {{present}}</p>
                <v-flex xs5 sm5 md5>
                  <v-sheet
                    class="d-flex"
                    color="green darken-1 lighten-3"
                    height="80"
                  >
                  <p class="text-lg-center"  style="padding:10px" ><i class="fa fa-user" style="font-size:50px;color:#1b5e20 "></i></p>

                  </v-sheet>
                </v-flex>
                </v-sheet>
              </v-flex>
              <v-flex
                xs12
                md4
                d-flex
                style="padding-right:5px ; padding-top:5px"
              >
                <v-sheet
                :elevation="10"
                  class="d-flex"
                  color="  white lighten-3"
                  height="80"

                >
                <p class="text-lg-left font-weight-black"  style="padding:10px ; color:black" >Absent : {{absent}}</p>
                <v-flex xs5 sm5 md5>
                  <v-sheet
                    class="d-flex"
                    color="yellow darken-1 lighten-3"
                    height="80"
                  >
                  <p class="text-lg-center"  style="padding:10px" ><i class="fa fa-user-slash" style="font-size:50px;color:#f57f17 "></i></p>
                  </v-sheet>
                </v-flex>
                </v-sheet>
              </v-flex>
            </v-layout>
            <v-layout
            flex-child
              wrap
              style="padding-top:15px "
              class="no-print"
               >
                  <v-flex xs12>
                <!-- <v-sheet
                color="#fafafa"> -->
                      <v-flex
                        xs12
                        md12
                        sm12

                      >
                      <div style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
                      <i class="fas fa-calendar-alt"></i> Generate Report
                      </div>
                    </v-flex>
                    <v-flex
                      xs12
                      md12
                      sm12
                      style=""
                    >
                    <div class="subheading font-weight-light text-lg-center">
                      User Name:{{selected.first_name}} {{selected.last_name}}
                    </div>
                  </v-flex>
                        <v-layout>

          <v-form ref="form" v-model="valid" lazy-validation >
            <v-container>
              <v-layout>
                <v-flex
                  xs12
                  md6
                >
                  <v-text-field
                  type="date"
                    v-model="startdate"
                    :rules="[  v => !!v || 'Start Date is required']"
                    :counter="10"
                    label="Start Date"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex
                  xs12
                  md6
                >
                  <v-text-field
                  type="date"
                    v-model="enddate"
                    :rules="[  v => !!v || 'End Date is required']"
                    :counter="10"
                    label="End Date"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex
                  xs12
                  md6
                >
                <v-btn
                  color="error"
                  @click="generaterept"
                >
                  Generate
                </v-btn>
                </v-flex>

              </v-layout>
            </v-container>
          </v-form>
                          </v-layout>
                        <!-- </v-container> -->
                </v-sheet>
              </v-flex>
            </v-layout>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 md5>
        <v-card tile flat>
          <v-card-text>
            <v-layout column style="height: 90vh">
              <v-flex md12 style="overflow: auto">
                       <v-data-table
                         :headers="headers"
                         :items="employee"
                         :rows-per-page-items="[100]"
                       >
                         <template slot="items" slot-scope="props" >
                           <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.first_name}} {{ props.item.last_name }}</td>
                           <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.type }}</td>

                           <td @click="empselected(props.item)">
                             <span v-if="props.item.status == 'Not Available'"> <v-icon small class="mr-2" @click="checkin(props.item)" >radio_button_checked</v-icon></span>
                             <span v-else> <v-icon small class="mr-2" color="green darken-2">radio_button_checked</v-icon></span>
                           </td>

                           <td @click="empselected(props.item)">
                             <span v-if="props.item.status == 'Available'"> <v-icon small class="mr-2" @click="checkout(props.item)" >radio_button_checked</v-icon></span>
                             <span v-else> <v-icon small class="mr-2" color="red darken-2">radio_button_checked</v-icon></span>
                           </td>
                         </template>
                       </v-data-table>
             </v-flex>
            </v-layout>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  <!-- </v-container> -->


<v-snackbar
class="no-print"
  v-model="snackbar"
  :bottom= "true"
  :right= "true"
  :timeout="timeout"
>
{{text}}
   <v-btn
     color="pink"
     flat
     @click="snackbar = false"
   >
     Close
   </v-btn>
 </v-snackbar>

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
    this.getemployees();
  },
  computed:
  {
    present(){
      var present = 0 ;
    for (var i = 0; i < this.employee.length; i++) {
    if(this.employee[i].status == 'Available')
    {
      present++;
    }
    }
    return present;
  },
  absent(){
  var absent = 0 ;
  for (var i = 0; i < this.employee.length; i++) {
  if(this.employee[i].status == 'Not Available')
  {
    absent++;
  }
  }
  return absent;
}
  },
  data (){
    return {
      reportview:[],
      valid: true,
      dialog: false,
      dialogm1: '',
      employee:[],
      select:[],
      selected:'',
      startdate:'',
      enddate:'',
      count:'',
      headers: [
        { text: 'Name',     align: 'right',   value: 'first_name' , sortable: false  },
        { text: 'Department',    align: 'right',   value: 'type' , sortable: false },
        { text: 'Check in',    align: 'right',   value: 'in' , sortable: false },
        { text: 'Check Out',    align: 'right',   value: 'out' , sortable: false },
      ],
      modalheaders: [
          { text: 'Date', align: 'right', value: 'date' ,sortable: false},
          { text: 'Check In', align: 'right', value: 'checkin' ,sortable: false},
          { text: 'Check Out', align: 'right', value: 'checkout' ,sortable: false},
          { text: 'Working Hours', align: 'right', value: 'hours' ,sortable: false},
          { text: 'Attendance', align: 'right', value: 'attendance' ,sortable: false},
          { text: 'Status', align: 'right', value: 'status',sortable: false }
        ],
    y: 'top',
    x: 'right',
snackbar: false,
 timeout: 6000,
 text: 'Select Employee From the Table',
    }
  },
  methods:{
getemployees()
    {
      axios.get('/employee/staff').then(response => {
          this.employee = response.data  ;
          this.count = this.employee.length  ;
         })
    },
    checkin(employee)
    {
      var moment = require('moment');
      axios.post('/attendance/checkin', {
      employee_id:employee.id,
      date:       moment().format('YYYY-MM-DD'),
      status:     'Present',
      checkin:    moment().format('HH:mm:ss'),
    })
        .then(response => {

        })
        axios.patch('/employee/status' , {
          employee_id:employee.id,
          status:"Available",
        })
        this.getemployees();
    },
    checkout(employee)
    {
      var moment = require('moment');

      axios.patch('/employee/status' , {
        employee_id:employee.id,
        status:"Not Available",
      })

      this.getemployees();

        axios.get('/attendance/getcheckin' , {
           params: {
                 employee_id:employee.id,
                 date:   moment().format('YYYY-MM-DD'),
                    }
         }).then(response => {
           var checkin = response.data;
           var start_date = moment(checkin, 'HH:mm:ss');
           var date = new Date();
           var end_date = moment(date,'HH:mm:ss');
           var x = end_date.diff(start_date);
           var duration = moment.duration(x);
           var hours = duration._data.hours +':'+ duration._data.minutes +':'+ duration._data.seconds;
           if(duration._data.hours < 4)
           {
             var daystatus = 'Half Day';
           }
           else {
             {
               var daystatus = 'Full Day';
             }
           }
      axios.patch('/attendance/checkout' , {
        employee_id:employee.id,
        date:   moment().format('YYYY-MM-DD'),
        checkout:moment().format('HH:mm:ss'),
        hours: hours,
        daystatus:daystatus,
      })
      .then(response => {

      })

  });
  },

  empselected(id)
  {
  this.selected = id;
},
generaterept()
{
  if (this.$refs.form.validate()) {
      if(this.selected)
      {
      axios.get('/attendance/report' , {
           params: {
                 employee_id:this.selected.id,
                 startdaate:this.startdate,
                 enddaate:this.enddate,
                    }
         }).then(response => {
           this.reportview = response.data.report
         });


        this.dialog = true
      }
      else {
        {
          this.snackbar = true
        }
      }
    }
},
  }
}
</script>
<style media="screen" scoped>
@media print
{
    .no-print, .no-print *
    {
        display: none !important;
    }
}
@page { size: auto;  margin: 0mm; }

.breadcrumb {
    padding: 5px 15px;
    margin-bottom: 0px;
    list-style: none;
    background-color: #f5f5f5;
    border-radius: 4px;
}
ul, ol {
    margin-top: 0;
    margin-bottom: 0px;
}
</style>
