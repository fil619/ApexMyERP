<template>
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#billing"><i class="fas fa-file-invoice-dollar"></i> Billing</a></li>
            <li class="active"><i class="fas fa-cash-register"></i> Counter Sale</li>
        </ol>
        <div class="row">


            <!-- Left-Side -->
            <div class="col-sm-12">

                <!-- Sale Panel -->
                
                <div class="panel panel-apex">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Add Sale
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form @keydown.enter.prevent="addSale" @keydown.ctrl.space.prevent="addSale">
                                <div class="row">
                                    <div class="form-group col-md-2 col-sm-12 col-xs-4">
                                        <label for="partCode">Part Code</label>
                                        <input type="text" class="form-control" id="partCode" placeholder="HS-742" @keydown.enter.prevent="getPart" v-model="counterSale.part_id">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 col-xs-8">
                                        <label for="partName">Part Name</label>
                                        <input type="text" class="form-control" id="partName" placeholder="Spark Plug" required v-model="counterSale.part_name">
                                    </div>
                                    <div class="form-group col-md-1 col-sm-6 col-xs-4">
                                        <label for="quantity">Qty</label>
                                        <input type="text" class="form-control" id="quantity" placeholder="2" required v-model="counterSale.quantity">
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="mrp">MRP</label>
                                        <input type="text" class="form-control" id="mrp" placeholder="120.00" required v-model="counterSale.sell_mrp">
                                    </div>
                                    <div class="form-group col-md-1 col-sm-6 col-xs-4">
                                        <label for="gst">GST %</label>
                                        <select class="form-control" id="gst" v-model="counterSale.gst_percent">
                                            <option value="12">12%</option>
                                            <option value="18">18%</option>
                                            <option value="28">28%</option>
                                            <option value="0">0%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="total">Total</label>
                                        <input type="text" class="form-control" id="total" placeholder="48.00" readonly v-bind:value="counterSale.sell_mrp * counterSale.quantity || 0">
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="transactionType">Pay by</label>
                                        <select class="form-control" id="transactionType" v-model="counterSale.transaction_type">
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="discount">Discount</label>
                                        <input type="text" class="form-control" id="discount" placeholder="48.00" v-model="counterSale.discount">
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="amount">Payable</label>
                                        <input type="text" class="form-control" id="amount" placeholder="500.00" v-bind:value="counterSale.amount=(counterSale.sell_mrp*counterSale.quantity)-counterSale.discount || 0" readonly>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="received">Received</label>
                                        <input type="text" class="form-control" id="received" placeholder="1000.00" v-model="counterSale.paid">
                                    </div>
                                    <div class="form-group col-md-2 col-sm-6 col-xs-4">
                                        <label for="return">Return</label>
                                        <input type="text" class="form-control" id="return" placeholder="300.00" v-bind:value="counterSale.returnable = counterSale.paid - counterSale.amount || 0" readonly>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="form-group col-md-offset-5 col-md-2 col-sm-offset-1 col-sm-5 col-xs-6">
                                        <button type="submit" class="btn btn-primary" @keydown.enter.prevent="addSale" @click.prevent="addSale"><i class="fas fa-cart-plus"></i> Add Sale</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Right-Side -->
            <div class="col-sm-12" id="bill-display">
                <div class="row">
                    <h4 class="text-center"><b>Counter Sales</b></h4>
                </div>
                <!-- <div class="row text-center">
                    <div class="col-sm-6 payable">Sales Amount
                        <span class="number"><i class="fas fa-rupee-sign"></i>14,000</span>
                    </div>
                    <div class="col-sm-6 paid">Parts Sold
                        <span class="number"><i class="fas fa-hashtag"></i>42</span>
                    </div>
                </div> -->
                <div class="row font-bold text-center line">
                    <div class="col-md-1">#</div>
                    <div class="col-md-5">Particulars</div>
                    <div class="col-md-1">Qty.</div>
                    <div class="col-md-2">Rate</div>
                    <div class="col-md-1">GST</div>
                    <div class="col-md-2">Amt</div>
                </div>
                <div class="row line" v-for="(s, index) in counterSales" v-bind:key="s.id">
                    <div class="col-md-1">{{ index + 1 }}</div>
                    <div class="col-md-5">{{ s.part_name }} <button class="del-btn" @click="removeSale(s)"><i class="far fa-times-circle"></i></button> </div>
                    <div class="col-md-1">{{ s.quantity }}</div>
                    <div class="col-md-2">{{ s.sell_mrp }}</div>
                    <div class="col-md-1">{{ s.gst_percent }}</div>
                    <div class="col-md-2">{{ s.amount }}</div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            document.getElementById("partCode").focus();
            axios.get('/getCounterSales').then(response => {
                this.counterSales = response.data;
            });
            this.counterSale.gst_percent = 12;
            this.counterSale.transaction_type = 'cash';
        },
        data(){
            return {
                counterSale: {},
                counterSales:[]
            }
        },
        methods: {
            getPart: function(){
                alert('You\'re not connected to inventory yet!');
            },
            addSale: function(){
                if(this.counterSale.part_name && this.counterSale.quantity && this.counterSale.sell_mrp && this.counterSale.gst_percent && this.counterSale.transaction_type && this.counterSale.paid){
                    axios.post('/addCounterSale', this.counterSale).then(response => {
                        this.counterSale = {};
                        this.counterSale.gst_percent = 12;
                        this.counterSale.transaction_type = 'cash';
                        this.counterSales.unshift(response.data);
                    });
                }
                else{
                    alert('Fill in all necessary details to add the sale!');
                }
                document.getElementById("partCode").focus();
            },
            removeSale: function(s){
                axios.delete('/deleteCounterSale/' +s.id +'/' +s.company_id).then(response => {
                    this.counterSales.splice(this.counterSales.indexOf(s),1);
                });
                document.getElementById("partCode").focus();
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
        background: linear-gradient(#F97F51,#F97F51);
        color: #ffffff;
        border: none;
        padding: 7px 10px;
        border-radius: 5px;
        transition: 0.8s ease-out;
    }

    #print-btn:hover{
        background: linear-gradient(#F97F51,#d35400);
    }

    .del-btn{
        background: none;
        border: none;
        color: #a10c0c;
        transition: 150ms ease-out;
    }

    .del-btn:hover{
        color: #ff3d3d;
    }
</style>


