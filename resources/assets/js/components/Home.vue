<template>
<v-app>
  <v-container text-xs-center grid-list-md>
    <!-- <v-container  style="background-color:#FFEBEE" grid-list-md text-xs-center> -->
      <v-form v-model="valid" ref="form" lazy-validation >
        <v-layout row wrap >
          <v-flex xs5 sm4 md5 >
                <v-text-field
                class="no-print"
                v-model="startdate"
                  label="Start Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs5 sm4 md5 >
                <v-text-field
                  class="no-print"
                  v-model="enddate"
                  label="End Date"
                  type="date"
                  required
                ></v-text-field>
          </v-flex>
          <v-flex xs10 sm2 md2>
                <v-btn
                class="no-print"
                  color="success"
                  @click="generate"
                >
                  Generate
                </v-btn>
          </v-flex>
        </v-layout>

      </v-form>
      <!-- </v-container> -->

      <v-container grid-list-md text-xs-center>
      <v-layout row wrap>
        <v-flex xs12 md4>
          <v-hover>
          <v-card
            slot-scope="{ hover }"
            :class="`elevation-${hover ? 12 : 2}`"
            class="mx-auto"
          >
          <div class="rad-info-box rad-txt-success" style="height:90px">
                 <i class="fa fa-users fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                 <span class="heading subheading font-weight-bold">EMPLOYEES</span>
                 <span class="value display-2 font-weight-medium"><span>4949</span></span>

         </div>
       </v-card>
</v-hover>
        </v-flex>
         <v-flex xs12 md4>

  <v-hover>
  <v-card
    slot-scope="{ hover }"
    :class="`elevation-${hover ? 12 : 2}`"
    class="mx-auto"
  >
           <div class="rad-info-box rad-txt-success" style="height:90px">
                  <i class="fa fa-tools fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                  <span class="heading subheading font-weight-bold">Vehicles Serviced</span>
                  <span class="value display-2 font-weight-medium"><span>4949</span></span>

          </div>
        </v-card>
 </v-hover>

        </v-flex>
         <v-flex xs12 md4>
           <v-hover>
           <v-card
             slot-scope="{ hover }"
             :class="`elevation-${hover ? 12 : 2}`"
             class="mx-auto"
           >
           <div class="rad-info-box rad-txt-success" style="height:90px">
                  <i class="fa fa-cogs fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                  <span class="heading subheading font-weight-bold">Parts Sold</span>
                  <span class="value display-2 font-weight-medium"><span>4949</span></span>

          </div>
        </v-card>
 </v-hover>
        </v-flex>
      </v-layout>
            <v-layout row wrap>
        <v-flex xs12 md4>
          <v-hover>
          <v-card
            slot-scope="{ hover }"
            :class="`elevation-${hover ? 12 : 2}`"
            class="mx-auto"
          >
          <div class="rad-info-box rad-txt-success" style="height:90px">
                 <i class="fa fa-user-tie fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                 <span class="heading subheading font-weight-bold">Customers</span>
                 <span class="value display-2 font-weight-medium"><span>4949</span></span>

         </div>
       </v-card>
</v-hover>
        </v-flex>
        <v-flex xs12 md4>
          <v-hover>
          <v-card
            slot-scope="{ hover }"
            :class="`elevation-${hover ? 12 : 2}`"
            class="mx-auto"
          >
           <div class="rad-info-box rad-txt-success" style="height:90px">
     							<i class="fa fa-cash-register fa-4x" style="float:left;vertical-align: middle; padding-left:10px ;padding-top:12px"></i>

                  <span class="heading subheading font-weight-bold">Revenue Generated</span>
     							<span class="value display-2 font-weight-medium"><span>4949</span></span>

     			</div>
        </v-card>
 </v-hover>
        </v-flex>
         <v-flex xs12 md4>
           <v-hover>
           <v-card
             slot-scope="{ hover }"
             :class="`elevation-${hover ? 12 : 2}`"
             class="mx-auto"
           >
           <div class="rad-info-box rad-txt-success" style="height:90px">
     							<i class="fa fa-money-bill-alt fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                  <span class="heading subheading font-weight-bold">Cash</span>
     							<span class="value display-2 font-weight-medium"><span>4949</span></span>

     			</div>
        </v-card>
 </v-hover>
        </v-flex>
      </v-layout>
            <v-layout row wrap>
        <v-flex xs12 md4>
          <v-hover>
          <v-card
            slot-scope="{ hover }"
            :class="`elevation-${hover ? 12 : 2}`"
            class="mx-auto"
          >
          <div class="rad-info-box rad-txt-success" style="height:90px">
                 <i class="fa fa-credit-card fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                 <span class="heading subheading font-weight-bold">Card</span>
                 <span class="value display-2 font-weight-medium"><span>4949</span></span>

         </div>
       </v-card>
</v-hover>
        </v-flex>
         <v-flex xs12 md4>
           <v-hover>
           <v-card
             slot-scope="{ hover }"
             :class="`elevation-${hover ? 12 : 2}`"
             class="mx-auto"
           >
           <div class="rad-info-box rad-txt-success" style="height:90px">
                  <i class="fa fa-file-invoice-dollar fa-4x" style="float:left;vertical-align:middle; padding-left:10px ; padding-top:12px"></i>
                  <span class="heading subheading font-weight-bold">GST Total</span>
                  <span class="value display-2 font-weight-medium"><span>4949</span></span>

          </div>
        </v-card>
 </v-hover>
        </v-flex>
         <v-flex xs12 md4>
           <v-hover>
           <v-card
             slot-scope="{ hover }"
             :class="`elevation-${hover ? 12 : 2}`"
             class="mx-auto"
           >
           <div class="rad-info-box rad-txt-success" style="height:90px">
     							<i class="fa fa-money-bill-wave fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

                  <span class="heading subheading font-weight-bold">Service Charges</span>
     							<span class="value display-2 font-weight-medium"><span>4949</span></span>

     			</div>
        </v-card>
 </v-hover>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
  <v-flex xs12 md4>
    <v-hover>
    <v-card
      slot-scope="{ hover }"
      :class="`elevation-${hover ? 12 : 2}`"
      class="mx-auto"
    >
    <div class="rad-info-box rad-txt-success" style="height:90px">
           <i class="fa fa-coins fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

           <span class="heading subheading font-weight-bold">Other Charges</span>
           <span class="value display-2 font-weight-medium"><span>4949</span></span>

   </div>
 </v-card>
</v-hover>
  </v-flex>
   <v-flex xs12 md4>
     <v-hover>
     <v-card
       slot-scope="{ hover }"
       :class="`elevation-${hover ? 12 : 2}`"
       class="mx-auto"
     >
     <div class="rad-info-box rad-txt-success" style="height:90px">
            <i class="fa fa-plus-circle fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

            <span class="heading subheading font-weight-bold">Additional Charges</span>
            <span class="value display-2 font-weight-medium"><span>4949</span></span>

    </div>
  </v-card>
</v-hover>
  </v-flex>
   <v-flex xs12 md4>
     <v-hover>
     <v-card
       slot-scope="{ hover }"
       :class="`elevation-${hover ? 12 : 2}`"
       class="mx-auto"
     >
     <div class="rad-info-box rad-txt-success" style="height:90px">
            <i class="fa fa-hand-holding-usd fa-4x" style="float:left;vertical-align: middle; padding-left:10px ; padding-top:12px"></i>

            <span class="heading subheading font-weight-bold">Advance Taken</span>
            <span class="value display-2 font-weight-medium"><span>4949</span></span>

    </div>
  </v-card>
</v-hover>
  </v-flex>
</v-layout>
    </v-container>
    </v-container>

</v-app>
</template>

<script>
import moment from 'moment';
import Vue from 'vue'
import VueNativeNotification from 'vue-native-notification'

Vue.use(VueNativeNotification, {
  requestOnNotify: true
})

    export default {
        mounted() {
          setInterval(function(){
      var CurrentDate = new Date();
      CurrentDate = moment(CurrentDate).format("YYYY-MM-DDTHH:mm");
      var addhour = moment(CurrentDate).add(1,'hours').format("YYYY-MM-DDTHH:mm");
      axios.get('/event/notification' , {
        params: {
                CurrDate: CurrentDate,
                EndDate: addhour+':00',
                }
      })
      .then(response => {
      this.Notifyevent = response.data.event  ;
      if (this.Notifyevent  != '' )
      {
        var title = this.Notifyevent[0].title;
        var start = this.Notifyevent[0].start;
        var end = this.Notifyevent[0].end;
        start = start.slice(11, 16);
        end = end.slice(11, 16);
        var type = this.Notifyevent[0].type;

        this.$notification.show( type + ' Event : '+ title  , {
          body: 'Starts At : '+ start + ' to ' + end,
          requireInteraction: true
        }, {})
      }
       })
     }.bind(this), 60000);
   },
        data() {
    return {
      Notifyevent:'',
      counter:'',
      startdate:'',
      enddate:'',
      valid:true
    }
    },
        methods:
        {
          generate()
          {

          }
        }
    }
</script>
<style media="screen" scoped>
.rad-info-box {
  /* margin-bottom: 16px; */
  box-shadow: 1px 1px 2px 0 #CCCCCC;
  /* padding: 20px; */
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  background: white !important;
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
    padding-right: 10px;
    padding-top: 10px;
    display: block;
    position: relative;
    color: #515d6e;
    text-align: right;
    z-index: 10;
}
.rad-info-box .value, .rad-info-box .heading {
    display: block;
    padding-right: 10px;
    position: relative;
    color: #515d6e;
    text-align: right;
    z-index: 10;
}
</style>
