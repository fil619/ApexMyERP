<template>
<v-app>
  <ol class="breadcrumb">
      <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Employee</a></li>
      <li class="active"><i class="fas fa-cash-register"></i>Report</li>
  </ol>
  <div>
<div  style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
<i class="fas fa-calendar-alt" ></i> Generate Report
</div>
  <v-form v-model="valid" ref="form" lazy-validation >
    <v-container fluid style="background-color:#FFEBEE">
        <v-layout row wrap>
          <v-flex xs12 sm6 md3>
                <v-select
                class="no-print"
                label="Select"
                :rules="[  v => !!v || 'Select an Employee']"
                v-bind:items="staff"
                v-model="employee"
                item-text="`${data.item.name}  ${data.item.group}`"
                item-value="id"
                autofocus
                >
                <template slot="selection" slot-scope="data">
                  {{ data.item.first_name}} {{data.item.last_name}}
                </template>
                <template slot="item" slot-scope="data">
                    <v-list-tile-content>
                      <v-list-tile-title v-html="`${data.item.first_name} ${data.item.last_name}`">
                      </v-list-tile-title>
                      <v-list-tile-sub-title v-html="data.item.type"></v-list-tile-sub-title>
                    </v-list-tile-content>
                  </template>
                </v-select>
          </v-flex>
          <v-flex xs12 sm6 md3 >
                <v-text-field
                class="no-print"
                v-model="startdate"
                  label="Start Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs12 sm6 md3 >
                <v-text-field
                  class="no-print"
                  v-model="enddate"
                  label="End Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs12 sm6 md3>
                <v-btn
                class="no-print"
                  color="success"
                  @click="generate"
                >
                  Generate
                </v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>

    <!-- <v-container grid-list-md text-xs-center> -->
      <v-layout row wrap justify-center style="padding-top:10px">
        <v-flex sm6 md6>
          <div class="text-xs-center">
            <strong style="color:#c62828" class="subheading font-weight-bold">Report Of:</strong >
              <strong class="subheading font-weight-bold"> {{getName}}</strong>
          </div>
        </v-flex>
        <v-flex sm6 md6>
          <!-- <div class="text-xs-center"> -->
          <strong style="color:#c62828" class="subheading font-weight-bold">For:</strong >
            <strong class="subheading font-weight-bold" v-if="enddate && onlystart"> {{startdate}}  <i class="fas fa-long-arrow-alt-right" ></i> {{enddate}}</strong>
          <strong class="subheading font-weight-bold" v-else> {{startdate}}</strong>
          <!-- </div> -->
        </v-flex>
      </v-layout>
    <!-- </v-container> -->

    <!-- <v-container > -->
      <v-layout justify-center align-start style="overflow-x:auto;">
        <v-flex sm6 md6 >
                   <table v-if="report">
                   <tr style="position:relative ; padding-top:10px">
                     <th style="background-color:#c62828">No.</th>
                     <th style="background-color:#c62828">Work Done</th>
                     <th style="background-color:#c62828">Bill No.</th>
                     <th style="background-color:#c62828">Vehicle No.</th>
                     <th style="background-color:#c62828">Date</th>
                     <th style="background-color:#c62828 ; padding-right:10px">Amount</th>
                   </tr>

                   <tr  v-for="(report , index ) in report">
                     <td>{{index}}</td>
                     <td>{{report.servicedetails}}</td>
                     <td>{{report.billno}}</td>
                     <td>{{report.servicecharge}}</td>
                     <td>{{report.date}}</td>
                     <td style="padding-right:10px">{{report.servicecharge}}</td>
                   </tr>
                   </table>
        </v-flex>
        <v-flex sm6 md6 >
                   <table v-if="report">
                   <tr style="position:relative ; padding-top:10px" >
                     <th style="background-color:#26C6DA">No.</th>
                     <th style="background-color:#26C6DA"  colspan="3">Advance Taken For</th>
                     <th style="background-color:#26C6DA">Date</th>
                     <th style="background-color:#26C6DA;padding-right:10px">Amount</th>
                   </tr>

                   <tr  v-for="(advancereport , index ) in advancereport">
                     <td>{{index}}</td>
                     <td colspan="3">{{advancereport.reason}}</td>
                     <td>{{advancereport.date}}</td>
                     <td style="padding-right:10px">{{advancereport.amount}}</td>
                   </tr>
                   </table>
        </v-flex>

    </v-layout>

      <v-layout justify-end align-start>
        <v-flex sm12 md6 >
           <table>
             <tr v-if="report">
               <th colspan="4"></th>
               <th style="text-align: left;">Earned:</th>
               <th style="padding-right:10px">{{earned}}</th>
             </tr>
           </table>
        </v-flex>
        <v-flex sm12 md6 >
          <table>
          <tr v-if="report">
            <th colspan="4"></th>
            <th style="text-align: left;">To be Deducted:</th>
            <th style="padding-right:10px">{{deducted}}</th>
          </tr>
        </table>
        </v-flex>
    </v-layout>
    <v-layout justify-end align-start>
      <v-flex sm12 md12 >
         <table>
           <tr v-if="report">
             <th colspan="4" style="background-color:#B2FF59"></th>
             <th style="background-color:#B2FF59 ; text-align: left;">Payable:</th>
             <th style="background-color:#B2FF59 ; padding-right:10px">{{total}}</th>
           </tr>
         </table>
      </v-flex>
  </v-layout>
  <!-- </v-container> -->
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
    this.getstaff();
  },
  computed:
{
  getName()
  {
for (var i = 0; i < this.staff.length; i++)
{
if ( this.employee == this.staff[i].id)
{
return this.staff[i].first_name +' '+ this.staff[i].last_name;
}
    }
  },
  earned()
  {
    var sum = 0;
    for (var i = 0; i < this.report.length; i++) {
      sum = sum + this.report[i].servicecharge;
    }
    this.income = sum;
    return sum;
  },
  deducted()
  {
    var sum = 0;
    for (var i = 0; i < this.advancereport.length; i++) {
      sum = sum + this.advancereport[i].amount;
    }
    this.advance = sum;
    return sum;
  },
  total()
  {
  var to
    return this.income - this.advance;
  },
},
  data(){
      return {
employee:'',
startdate:new Date().toISOString().substr(0, 10),
enddate:'',
income:'',
onlystart:'',
advance:'',
report:'',
advancereport:'',
valid:true,
staff:[]
      }
  },
  methods:
  {
    generate () {
      if (this.$refs.form.validate()) {
        this.onlystart = true;
        if(!this.enddate)
        {
          this.enddate = this.startdate;
          this.onlystart = false;
        }
        axios.get('/repair/empreport',{
          params: {
                employee_id:this.employee,
                startdate:this.startdate,
                enddate:this.enddate,
                   }
        }).then(response => {
          this.report = response.data  ;
         })


           axios.get('/advance/report',{
             params: {
                   employee_id:this.employee,
                   startdate:this.startdate,
                   enddate:this.enddate,
                      }
           }).then(response => {
             this.advancereport = response.data  ;
            })

      }
    },
    getstaff()
    {
      axios.get('/employee/staff').then(response => {
        this.staff = response.data  ;
       })
    }
  }
}
</script>

<style lang="css" scoped>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: right;
  padding: 10px 0px 10px 0px;

}

tr:nth-child(even) {
  background-color: #f2f2f2
}

@media print
{
    .no-print, .no-print *
    {
        display: none !important;
    }
}
@page { size: auto;  margin: 0mm; }
</style>
