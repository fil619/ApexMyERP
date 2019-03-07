<template>
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Billing</a></li>
            <li class="active"><i class="fas fa-oil-can"></i> Spare Part</li>
        </ol>
        <div class="row">


            <!-- Left-Side -->
            <div class="col-sm-6">
                <div class="panel-group" id="accordion">

                    <!-- Customer Panel -->

                    <div class="panel panel-apex">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Customer Details</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <form @keydown.enter.prevent>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-12 col-xs-4">
                                            <label for="billNo">Bill No</label>
                                            <input type="text" class="form-control" id="billNo" placeholder="1403" @keydown.enter.prevent="getBill" autofocus v-model="bill.id">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-12 col-xs-8">
                                            <label for="vehicleNo">Vehicle No.</label>
                                            <input type="text" class="form-control" id="vehicleNo" placeholder="GA 08 M 4328" @keydown.ctrl.space.prevent="startBill" @keyup.enter.prevent="getBill" v-model="customer.vehicle_no">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12 col-xs-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Rohan Naik" @keydown.ctrl.space.prevent="startBill" v-model="customer.name">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 col-xs-6">
                                            <label for="mobile">Contact</label>
                                            <input type="text" class="form-control" id="mobile" placeholder="9822XXXXX0" @keydown.ctrl.space.prevent="startBill" v-model="customer.mobile">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12 col-xs-8">
                                            <label for="gst">GST No.</label>
                                            <input type="text" class="form-control" id="gst" placeholder="30XXXXXXXXXX2Z5" v-model="customer.gst_no">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-offset-3 col-md-3 col-sm-offset-1 col-sm-5 col-xs-offset-1 col-xs-4">
                                            <button type="submit" class="btn btn-success" @click.prevent="getBill"><i class="fas fa-file-import"></i> Get Bill</button>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-5 col-xs-4">
                                            <button type="submit" class="btn btn-primary" @click.prevent="startBill"><i class="fas fa-play"></i> Start Bill</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Parts Panel -->
                    
                    <div class="panel panel-apex">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Add Sale</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form @keydown.enter.prevent="addPart" @keydown.ctrl.space.prevent="addPart">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-12 col-xs-4">
                                            <label for="partCode">Part Code</label>
                                            <input type="text" class="form-control" id="partCode" placeholder="HS-742" @keydown.enter.prevent="getPart" v-model="sale.part_id">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-12 col-xs-8">
                                            <label for="partName">Part Name</label>
                                            <input type="text" class="form-control" id="partName" placeholder="Spark Plug" required v-model="sale.part_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="quantity">Qty</label>
                                            <input type="text" class="form-control" id="quantity" placeholder="2" required v-model="sale.quantity">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="mrp">MRP</label>
                                            <input type="text" class="form-control" id="mrp" placeholder="120.00" required v-model="sale.sell_mrp">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="gst">GST %</label>
                                            <select class="form-control" v-model="sale.gst_percent">
                                                <option value="12">12%</option>
                                                <option value="18">18%</option>
                                                <option value="28">28%</option>
                                                <option value="0">0%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary" @click.prevent="addPart"><i class="fas fa-cart-plus"></i> Add Part</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Panel -->

                    <div class="panel panel-apex">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Payment</a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form @keydown.enter.prevent="updatePayment" @keydown.ctrl.space.prevent="updatePayment">
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="transactionType">Pay by</label>
                                            <select class="form-control" id="transactionType" v-model="bill.transaction_type">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="advance">Advance</label>
                                            <input type="text" class="form-control" id="advance" placeholder="500.00" v-model="bill.advance">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="balance">Balance</label>
                                            <input type="text" class="form-control" id="balance" placeholder="748.00" v-model="bill.balance">
                                        </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="discount">Discount</label>
                                            <input type="text" class="form-control" id="discount" placeholder="48.00" v-model="bill.discount">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="received">Received</label>
                                            <input type="text" class="form-control" id="received" placeholder="1000.00" v-model="bill.paid">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-4">
                                            <label for="return">Return</label>
                                            <input type="text" class="form-control" id="return" placeholder="300.00" v-model="bill.returnable">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="form-group col-md-offset-3 col-md-3 col-sm-offset-1 col-sm-5 col-xs-offset-1 col-xs-4">
                                            <button type="submit" class="btn btn-primary" @click.prevent="updatePayment"><i class="fas fa-rupee-sign"></i> Add Pay</button>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-5 col-xs-5">
                                            <button type="submit" class="btn btn-success" @click.prevent="updatePayment"><i class="fas fa-sync-alt"></i> Update Pay</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Right-Side -->
            <div class="col-sm-6" id="bill-display">
                <button id="print-btn"><i class="fas fa-print"></i> Print</button>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-5">Bill #: {{bill.id}}</div>
                    <div class="col-sm-5">Date: {{ new Date().getDate() }}/{{ new Date().getMonth() }}/{{ new Date().getFullYear() }}</div>

                    <div class="col-sm-offset-2 col-sm-5">To: {{customer.name}}</div>
                    <div class="col-sm-5">Veh #: {{customer.vehicle_no}}</div>

                    <div class="col-sm-offset-2 col-sm-5">Phone: {{customer.mobile}}</div>
                    <div class="col-sm-5">GST #: {{customer.gst_no}}</div>
                </div>
                <div class="row">
                    <h4 class="text-center"><b>TAX INVOICE</b></h4>
                </div>
                <div class="row text-center">
                    <div class="col-sm-4 payable">Payable
                        <span class="number"><i class="fas fa-rupee-sign"></i>{{bill.balance}}</span>
                    </div>
                    <div class="col-sm-4 paid">Paid
                        <span class="number"><i class="fas fa-rupee-sign"></i>{{bill.paid}}</span>
                    </div>
                    <div class="col-sm-4 return">Return
                        <span class="number"><i class="fas fa-rupee-sign"></i>{{bill.returnable}}</span>
                    </div>
                </div>
                <div class="row font-bold text-center line">
                    <div class="col-md-1">#</div>
                    <div class="col-md-5">Particulars</div>
                    <div class="col-md-1">Qty.</div>
                    <div class="col-md-2">Rate</div>
                    <div class="col-md-1">GST</div>
                    <div class="col-md-2">Amt</div>
                </div>
                <div class="row line" v-for="(s, index) in sales" v-bind:key="s.id">
                    <div class="col-xs-1">{{ index + 1 }}</div>
                    <div class="col-xs-5">{{ s.part_name }}</div>
                    <div class="col-xs-1">{{ s.quantity}}</div>
                    <div class="col-xs-2">{{ s.sell_mrp }}</div>
                    <div class="col-xs-1">{{ s.gst_percent }}</div>
                    <div class="col-xs-2">{{ s.quantity*s.sell_mrp}}</div>
                </div>
                <div class="row line">
                    <div class="col-md-10 text-right">
                        <strong>Sub-total</strong>
                    </div>
                    <div class="col-md-2">{{bill.sub_total}}</div>
                </div>
                <div class="row line">
                    <div class="col-md-10 text-right">
                        <strong>Discount</strong>
                    </div>
                    <div class="col-md-2">{{bill.discount}}</div>
                </div>
                <div class="row line">
                    <div class="col-md-10 text-right">
                        <strong>TOTAL</strong>
                    </div>
                    <div class="col-md-2">{{bill.grand_total}}</div>
                </div>
                <div class="row line">
                    <div class="col-md-10 text-right">
                        <strong>Advance</strong>
                    </div>
                    <div class="col-md-2">{{bill.advance}}</div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            document.getElementById("billNo").focus();
            this.bill.type = 'sales';
            this.sale.gst_percent = 12;
            window.addEventListener('keydown', function(e){
                if(e.ctrlKey && e.keyCode==49){
                    e.preventDefault();
                    document.querySelectorAll('a[href^="#collapse1"]')[0].click();
                    document.getElementById("billNo").focus();
                } else if(e.ctrlKey && e.keyCode==50){
                    e.preventDefault();
                    document.querySelectorAll('a[href^="#collapse2"]')[0].click();
                    document.getElementById("partCode").focus();
                } else if(e.ctrlKey && e.keyCode==51){
                    e.preventDefault();
                    document.querySelectorAll('a[href^="#collapse4"]')[0].click();
                    document.getElementById("transactionType").focus();
                } else if(e.ctrlKey && e.keyCode==80){
                    e.preventDefault();
                    alert("Print Bill");
                }
            });
        },
        data(){
            return {
                bill: {},
                customer: {},
                sale: {},
                sales: []
            }
        },
        methods: {
            getBill: function(){
                if(this.customer.mobile || this.customer.vehicle_no){
                    if(this.customer.name){
                        this.customer.name = this.parseNameField(this.customer.name);
                    }
                    if(this.customer.vehicle_no){
                        this.parseVehicleNo();
                    }
                    axios.post('/addCustomer', this.customer).then(response => {
                        this.customer = response.data;
                        axios.post('/getBill', {customer_id: this.customer.id, type: this.bill.type}).then(response => {
                            if(response.data == 0){
                                alert('No bill for this customer has been started!');
                            } else {
                                this.bill = response.data;
                                axios.post('/getSales', {company_id: this.bill.company_id, bill_id: this.bill.id}).then(response => {
                                    this.sales = response.data;
                                });
                            }
                        });
                    });
                    document.getElementById("billNo").focus();
                } else if (this.bill.id) {
                    axios.post('/getBill', {id: this.bill.id, type: this.bill.type}).then(response => {
                        if(response.data == 0){
                            alert('No bill for this customer has been started!');
                        } else {
                            this.bill =response.data;
                            axios.post('/addCustomer', {id: this.bill.customer_id}).then(response => {
                                this.customer = response.data;
                                axios.post('/getSales', {company_id: this.bill.company_id, bill_id: this.bill.id}).then(response => {
                                    this.sales = response.data;
                                });
                            });
                        }
                    });
                }
            },
            startBill: function(){
                if(this.customer.mobile || this.customer.vehicle_no){
                    if(this.customer.name){
                        this.customer.name = this.parseNameField(this.customer.name);
                    }
                    if(this.customer.vehicle_no){
                        this.parseVehicleNo();
                    }
                    axios.post('/addCustomer', this.customer).then(response => {
                        this.customer = response.data;
                        axios.post('/startBill', {customer_id: this.customer.id, type: this.bill.type}).then(response => {
                            this.bill = response.data;
                            axios.post('/getSales', {company_id: this.bill.company_id, bill_id: this.bill.id}).then(response => {
                                this.sales = response.data;
                            });
                        });
                    });
                    document.getElementById("billNo").focus();
                } else {
                    alert('Select Mechanic to start the bill!');
                    document.getElementById("mechanic").focus();
                }
            },
            getPart: function(){
                alert('Not connected with Inventory yet!');
            },
            addPart: function(){
                if (this.sale.part_name && this.sale.quantity && this.sale.sell_mrp && this.sale.gst_percent && this.bill.id){
                    this.sale.company_id = this.bill.company_id;
                    this.sale.bill_id = this.bill.id;
                    axios.post('/addSale', this.sale).then(response => {
                        this.sale = {};
                        this.sale.gst_percent = 12;
                        this.sales.push(response.data);
                        axios.post('/updateBill', this.bill).then(response => {
                            this.bill = response.data;
                        });
                    });
                } else {
                    alert('Fill the required field to add the sale!');
                }
                document.getElementById("partCode").focus();
            },
            updatePayment: function(){
                if(this.bill.transaction_type){
                    axios.post('/updateBill', this.bill).then(response => {
                        this.bill = response.data;
                    });
                }else{
                    alert('Select Transaction type!');
                    document.getElementById("transactionType").focus();
                }
            },
            parseVehicleNo: function (){
                var vn = this.customer.vehicle_no;
                var nvn = "";
                for(var i = 0; i < vn.length; i++){
                    var c = vn.charAt(i);
                    if(c.match(/^[A-Za-z]+$/)){
                        nvn = nvn + c.toUpperCase();
                    }
                    else if(c.match(/^\d+$/)){
                        var cp = vn.charAt(i-1);
                        var cn = vn.charAt(i+1);
                        if(cp.match(/^[A-Za-z]+$/)){
                            nvn = nvn + ' ' +c;
                        }else if(cn.match(/^[A-Za-z]+$/)){
                            nvn = nvn +c +' ';
                        }else{
                            nvn = nvn +c;
                        }
                    }
                    else{
                        nvn = nvn + ' ';
                    }
                }
                this.customer.vehicle_no = nvn;
            },
            parseNameField: function (val){
                var cn = val;
                var ncn = '';
                for(var i = 0; i < cn.length; i++){
                    var c = cn.charAt(i);
                    if(c.match(/^[A-Za-z]+$/)){
                        if(i==0){
                            ncn = ncn + c.toUpperCase();
                        }
                        else{
                            var cp = cn.charAt(i-1);
                            if(cp.match(/\s/)){
                                ncn = ncn + c.toUpperCase();
                            }
                            else{
                                ncn = ncn + c;
                            }
                        }
                    }
                    else{
                        ncn = ncn + c;
                    }
                }
                return ncn;
            }
        },
        
    }
</script>

<style scoped>
    i{
        padding-right: 5px;
        padding-left: 5px;
    }

    .panel-apex .panel-heading{
        background-color: #fa8231;
        color: #fff;
    }

    a:hover, a:focus{
        text-decoration: none;
        color: #fff;
    }

    .font-bold{
        font-weight: bold;
    }

    .payable, .paid, .return{
        color: #ffffff;
        padding: 8px 0;
    }

    .payable{
        background: #00cec9;
    }

    .paid{
        background: #fdcb6e;
    }

    .return{
        background: #ff7675;
    }

    .number{
        display: block;
        font-size: 1.8em;
        color: #fff;
    }
    
    .line{
        padding: 5px 0;
        border-bottom: solid 1px #CAD3C8;
    }

    #bill-display{
        position: relative;
    }

    #print-btn{
        position: absolute;
        top: 0;
        left: 0;
        background: linear-gradient(#1B9CFC,#1B9CFC);
        color: #ffffff;
        border: none;
        padding: 7px 10px;
        border-radius: 5px;
        transition: 250ms ease-out;
    }

    #print-btn:hover{
        background: linear-gradient(#1B9CFC,#0652DD);
    }
</style>


