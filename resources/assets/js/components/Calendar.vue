<template>
  <v-app>
    <div style="color:white ; background-color:#fa8231 ; font-size: 16px ;padding: 8px 12px;">
      <i class="fas fa-cart-plus"></i> Calendar
    </div>
    <div class="container" id="cont">
      <!-- <ol class="breadcrumb">
          <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Billing</a></li>
          <li class="active"><i class="fas fa-cash-register"></i> Counter Sale</li>
      </ol> -->
      <v-form
   ref="form"
   v-model="valid"
   lazy-validation
 >

      <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Add Event on {{displaydate}}</h4>
                          </div>
                          <div class="modal-body">
                              <v-text-field
                                   v-model="eventinfo"
                                   :counter="20"
                                   label="Event"
                                   :rules="EventRules"
                                   required
                                 ></v-text-field>
                                <v-container>
                                  <v-layout row wrap>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="starttime"
                                        type="time"
                                        :rules="[v => !!v || 'Start Time is required']"
                                        label="Start(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="endtime"
                                        type="time"
                                        :rules="[v => !!v || 'End Time is required' ,
                                                 v => (!!v && v) > this.starttime || 'End Date should be greater than start Date']"
                                        label="End(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>


                                  </v-layout>
                                </v-container>

                            <v-select
                             :items="type"
                             v-model="eventtype"
                             :rules="[v => !!v || 'Select Event Type']"
                             label="Event Type"
                             solo
                           ></v-select>
                          </div>
                          <div class="modal-footer">
                            <v-btn
                                :disabled="!valid"
                                color="success"
                                @click="addevent"
                              >
                                Add Event
                            </v-btn>
                            <v-btn
                                color="error"
                                data-dismiss="modal"
                              >
                                Cancel
                              </v-btn>

                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <!-- <button type="button" class="btn btn-primary" @click="addevent()">Submit</button> -->
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </v-form>

            <v-form
         ref="updateform"
         v-model="validUpdate"
         lazy-validation
       >
              <div class="modal fade" tabindex="-1" role="dialog" id="edit_post_model">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Edit Event</h4>
                                  </div>
                                  <div class="modal-body">

                                    <!-- <md-field>
                                      <label>Event</label>
                                       <md-input v-model="updateevent"></md-input>
                                    </md-field> -->

                                    <v-text-field
                                         v-model="updateevent"
                                         :counter="20"
                                         label="Event"
                                         :rules="EventRules"
                                         required
                                       ></v-text-field>
                                        <v-container>
                                          <v-layout row wrap>

                                            <v-flex xs12 sm6 md6>
                                              <v-text-field
                                              v-model="update_start"
                                                type="time"
                                                label="Start Time"
                                                :rules="[v => !!v || 'Start Time is required']"
                                                prepend-inner-icon="timer"
                                                box
                                              ></v-text-field>
                                            </v-flex>

                                            <v-flex xs12 sm6 md6>
                                              <v-text-field
                                              v-model="update_end"
                                                type="time"
                                                label="End Time"
                                                prepend-inner-icon="timer"
                                                :rules="[v => !!v || 'End Time is required' ,
                                                         v => (!!v && v) > this.update_start || 'End Date should be greater than start Date']"
                                                box
                                              ></v-text-field>
                                            </v-flex>
                                          </v-layout>
                                        </v-container>
                                    <v-select
                                     :items="type"
                                     v-model="updatetype"
                                     label="Event Type"
                                     :rules="[v => !!v || 'Select Event Type']"
                                     solo
                                   ></v-select>


                                  </div>
                                  <div class="modal-footer">
                                    <v-btn
                                        :disabled="!validUpdate"
                                        color="success"
                                        @click="editevent"
                                      >
                                        Update
                                    </v-btn>
                                    <v-btn
                                        color="warning"
                                        data-dismiss="modal"
                                      >
                                        Cancel
                                      </v-btn>
                                      <v-btn
                                          color="error"
                                          @click="delevent"
                                        >
                                          Delete
                                      </v-btn>
<!--
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="delevent()">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" @click="editevent()">Update</button> -->
                                  </div>
                              </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                    </v-form>

{{isdate}}
          <v-container fluid style="padding:0px 10px">

            <v-form
         ref="isform"
         v-model="isvalid"
         lazy-validation
       >
                <v-layout row wrap>
                  <v-flex xs12 sm6 md2>
                    <v-card  tile flat>
                      <v-card-text>
                        <v-text-field
                             v-model="iseventinfo"
                             label="Event"
                             :rules="[v => !!v || 'Event is required']"
                             required
                           ></v-text-field>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 sm6 md2>
                    <v-card  tile flat>
                      <v-card-text>
                        <v-text-field
                             v-model="isdate"
                             label="Date"
                             type="date"
                             :rules="[v => !!v || 'Date is required']"
                             required
                           ></v-text-field>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 sm6 md2>
                    <v-card  tile flat>
                      <v-card-text>
                        <v-text-field
                        v-model="isstarttime"
                          type="time"
                          :rules="[v => !!v || 'Start Time is required']"
                          label="Start Time"
                          prepend-inner-icon="timer"
                        ></v-text-field>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 sm6 md2>
                    <v-card  tile flat>
                      <v-card-text>
                        <v-text-field
                        v-model="isendtime"
                          type="time"
                          :rules="[v => !!v || 'End Time is required' ,
                                   v => (!!v && v) > this.isstarttime || 'End Date should be greater than start Date']"
                          label="End Time"
                          prepend-inner-icon="timer"
                        ></v-text-field>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 sm6 md2>
                    <v-card  tile flat>
                      <v-card-text>
                        <v-select
                         :items="type"
                         v-model="iseventtype"
                         :rules="[v => !!v || 'Select Event Type']"
                         label="Event Type"
                       ></v-select>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                  <v-flex xs12 sm6 md1>
                    <v-card  tile flat>
                      <v-card-text>
                      </v-card-text>
                    </v-card>

                    <v-btn
                        :disabled="!valid"
                        color="success"
                        @click="isaddevent"
                      >
                        Add Event
                    </v-btn>
                    <!-- <v-btn
                        color="error"
                        type="reset"
                        style="min-width: 112px;"
                      >
                         Reset
                      </v-btn> -->
                      <v-card  tile flat>
                        <v-card-text>
                        </v-card-text>
                      </v-card>
                  </v-flex>

                </v-layout>
</v-form>

      <v-layout row wrap>
        <v-flex xs12 md4>
          <v-sheet
          class="d-flex"
          color="white"
          id="ListCalendar"
          >
          <full-calendar ref="calendar" :config="configlist" :events="get_event"></full-calendar>
        </v-sheet>
        </v-flex>
        <v-flex xs12 md8>
              <v-sheet
                class="d-flex"
                color="grey lighten-3"
              >
              <full-calendar :events="get_event" @event-selected="EventSelected"  @day-click="multipledate" :config="config" @event-drop="dragged" ></full-calendar>
              </v-sheet>
        </v-flex>
      </v-layout>
    </v-container>

    </div>
  </v-app>
</template>

<script>
import Vue from 'vue';
import 'fullcalendar/dist/fullcalendar.css';
import FullCalendar from 'vue-full-calendar';
Vue.use(FullCalendar);

    export default {
        name: 'DialogPrompt',
        mounted()
        {
          this.getcalendarevent();
        },
        data() {
    return {
      eventinfo:'',

      iseventinfo:'',
      isstarttime:'',
      isendtime:'',
      iseventtype:'',


      updateid:'',
      update_start:'',
      update_startdate:'',
      update_end:'',
      update_enddate:'',
      updatetype:'',
      updateevent:'',

      fullstart:'',
      fullend:'',
      displaydate:'',
      updateend:'',
      starttime:'',
      endtime:'',
      dragevent:'',
      eventtype:'',
      date:'',
      isdate:'',
      get_event:[],

      isvalid: true,
      valid: true,
      validUpdate: true,
      EventRules: [
        v => !!v || 'Event is required',
        v => (v && v.length <= 20) || 'Event must be less than 20 characters'
      ],

      type: ['Personal', 'Business'],
      configlist:{
        defaultView:"listDay",
        header: {
          left:   'prev,next today',
          center: 'title',
          right:  'listDay'
   }
      },
      config:{
        defaultView:"month",
        eventLimit: 3,
        header: {
     left:   'prev,next today',
     center: 'title',
     right:  'month'
   }
      },
    active: false,
    Sel_day:'',
    value: null
    }
  },
  methods:{
    validate () {
    if (this.$refs.form.validate()) {
      this.snackbar = true;
      alert('all true')
    }
  },
    dragged(drevent){
      axios.patch('/event/update'+ drevent.id ,  {
        id: drevent.id,
        title: drevent.title,
        type: drevent.type,
        start:drevent.start.format(),
        end:drevent.end.format(),
        allDay:drevent.allDay,
        color:drevent.color,
      })
      this.getcalendarevent();
    },
    onConfirm () {
      this.value = '';

      },
      multipledate(date)
      {
        this.date = date ;
        this.displaydate = date.format() ;
        $("#calendar").fullCalendar('gotoDate', date);
        this.$refs.form.reset();
        this.$refs.form.resetValidation();

        // $("#add_post_model").modal("show");
},
getcalendarevent()
{
  axios.get('/event').then(response => {
  this.get_event = response.data.event  ;
   })
},
addevent()
{
  if (this.$refs.form.validate()) {
    this.snackbar = true;
  var colour ;
  if(this.eventtype == 'Personal')
  {
    colour = '#4a148c';
  }
  else
  {
    colour = '#004d40';
  }
  this.fullstart = this.date.format()+'T' + this.starttime +':00';
  this.fullend = this.date.format()+'T' + this.endtime +':00' ;
  axios.post('/event', {
  title:this.eventinfo,
  type:this.eventtype,
  start: this.fullstart,
  end: this.fullend,
  allDay:false,
  color:colour,
})
    .then(response => {
      this.eventtype = '';
      this.eventinfo = '';
      $("#add_post_model").modal("hide");
      this.getcalendarevent();
    })
  }
},
isaddevent()
{
  if (this.$refs.isform.validate()) {
    this.snackbar = true;
  var colour ;
  if(this.eventtype == 'Personal')
  {
    colour = '#4a148c';
  }
  else
  {
    colour = '#004d40';
  }
  console.log(this.isdate);
  this.fullstart = this.isdate+'T' + this.isstarttime +':00';
  this.fullend = this.isdate+'T' + this.isendtime +':00' ;
  console.log(this.fullstart);
  axios.post('/event', {
  title:this.iseventinfo,
  type:this.iseventtype,
  start: this.fullstart,
  end: this.fullend,
  allDay:false,
  color:colour,
})
    .then(response => {
      this.eventtype = '';
      this.eventinfo = '';
      $("#add_post_model").modal("hide");
      this.getcalendarevent();
      this.$refs.isform.reset();
      this.iseventinfo='';
    this.iseventtype='';
     this.fullstart='';
    this.fullend='';
    })
  }
},
EventSelected(selevent, jsEvent, view){
this.updateid = selevent.id;
this.updateevent = selevent.title;
this.updatetype = selevent.type;

var startdate = selevent.start._i;
var enddate = selevent.end._i;

startdate = startdate.slice(0, 10);
enddate = enddate.slice(0, 10);
this.update_startdate = startdate;
this.update_enddate = enddate;


startdate = selevent.start._i;
enddate = selevent.end._i;
startdate = startdate.slice(11, 16);
enddate = enddate.slice(11, 16);
this.update_start = startdate;
this.update_end = enddate;


this.$refs.updateform.resetValidation();
  $("#edit_post_model").modal("show");
},

editevent(){
  if (this.$refs.updateform.validate()) {
    this.snackbar = true;
  var colour ;
  if(this.updatetype == 'Personal')
  {
    colour = '#4a148c';
  }
  else
  {
    colour = '#004d40';
  }
  axios.patch('/event/update'+ this.updateid ,  {
    id: this.updateid,
    title: this.updateevent,
    type: this.updatetype,
    start: this.update_startdate  +'T'+this.update_start+':00' ,
    end: this.update_enddate +'T'+this.update_end+':00' ,
    allDay:false,
    color:colour,
  }) .then(response => {
    $("#edit_post_model").modal("hide");
    this.updateevent='';
    this.updatetype='';
    this.update_startdate='';
    this.update_enddate='';
    this.update_start='';
    this.update_end='';
    this.getcalendarevent();

      })
    }
},
delevent()
{
  console.log(this.updateid);
  axios.delete('/event/destroy' , {
    params: {
            id:this.updateid,
            }
  })
  .then(response => {
    this.getcalendarevent();
    $("#edit_post_model").modal("hide");
  })
}

  }
    }
</script>
<style media="screen" >
#cont
  {
    padding:5px !important;
  }
  .application--wrap
  {
    min-height: 0vh !important;
  }
  .fc-event{
    color: white !important;
  }
  #ListCalendar .fc-scroller{
    height: 410px !important ;
  }

  .fc-time{
    font-size: 15px !important;
    font-weight: bold !important;
  }

  #ListCalendar .fc-toolbar{
    display: none !important;
  }

</style>
