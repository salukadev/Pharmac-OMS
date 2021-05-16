<template>
    <Layout title="Recurring Orders">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Recurring Order Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->

                                    <v-card>
                                        <div style="text-align: right; padding: 20px">
                                            <!-- recurring order ADD FORM -->

                                                    <v-dialog
                                                        v-model="form"
                                                        persistent
                                                        max-width="500px"
                                                    >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn
                                                                color="primary"
                                                                dark
                                                                v-bind="attrs"
                                                                v-on="on"
                                                            >
                                                                <v-icon dark>add</v-icon>
                                                                Create
                                                            </v-btn>
                                                        </template>
                                                        <v-card>
                                                            <v-card-title>
                                                                <span class="headline">{{ formTitle }}</span>
                                                            </v-card-title>
                                                            <v-card-text>
                                                                <v-container >

                                                                    <v-form
                                                                        ref="addform"
                                                                        v-model="valid"
                                                                        lazy-validation
                                                                    >
                                                                        <v-select
                                                                        v-model="addform.customer_id"
                                                                        :items="users"
                                                                        :rules="[v => !!v || 'Customer ID is required']"
                                                                        label="Customer ID"
                                                                        required
                                                                    ></v-select>

                                                                        <v-select
                                                                            v-model="addform.cart_id"
                                                                            :items="carts"
                                                                            :rules="[v => !!v || 'Cart ID is required']"
                                                                            label="Cart ID"
                                                                            required
                                                                        ></v-select>

                                                                        <v-text-field
                                                                            label="Frequency (Days)"
                                                                            v-model="addform.frequency"
                                                                            :counter="3"
                                                                            :rules="[v => !!v || 'Frequency is required']"
                                                                            required
                                                                        ></v-text-field>
                                                                        <br>
                                                                        <h4>Repeat Until (Select Date):</h4>
                                                                        <v-row
                                                                            cols="6"
                                                                            sm="6"
                                                                            class="my-2 px-1"
                                                                        >

                                                                            <v-date-picker
                                                                                ref="picker"
                                                                                v-model="addform.endDate"
                                                                                width="260"
                                                                                class="mt-3"
                                                                                :min="minDate"
                                                                                :landscape="landscape"

                                                                            ></v-date-picker>
                                                                        </v-row>


                                                                        <v-btn
                                                                            color="error"
                                                                            class="mr-4"
                                                                            @click="closeForm"
                                                                        >
                                                                            Close
                                                                        </v-btn>
                                                                        <v-btn
                                                                            color="error"
                                                                            class="mr-4"
                                                                            @click="submit"
                                                                        >
                                                                            Save
                                                                        </v-btn>


                                                                    </v-form>
                                                                </v-container>
                                                            </v-card-text>

                                                        </v-card>
                                                    </v-dialog>

                                            <!-- ADD FORM ENDS HERE -->
                                        </div>
                                        <v-card-title>
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
                                            :items="recurringOrders"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{row.item.id}}</td>
                                                    <td>{{row.item.customer_id}}</td>
                                                    <td>{{row.item.cart_id}}</td>
                                                    <td>{{row.item.frequency}}</td>
                                                    <td>{{row.item.endDate}}</td>
                                                    <td>
                                                        <v-btn color="indigo darken-4" icon @click="editItem(row.item)">
                                                            <v-icon dark>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>
                                                    <td>
                                                        <v-btn color="red darken-3" icon  @click="deleteItem(row.item.id)">
                                                            <v-icon dark>delete</v-icon>
                                                        </v-btn>
                                                    </td>
                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                                <br><br>
                                <div style="text-align: right; padding-right: 20px">
                                    <v-btn color="blue" dark href="">
                                        <v-icon  dark>book</v-icon>
                                        Generate Report
                                    </v-btn>
                                </div>
                            </div>

                            <!-- end content-->
                        </div>
                        <!--  end card  -->
                    </div>
                    <!-- end col-md-12 -->
                </div>
            </div>
        </v-app>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

export default {
    name: "RecurringOrderDetails",
    components:{
        Layout,
    },
    props:{
        recurringOrders:Array,
        recurringOrder: Object,
        users:Array,
        carts:Array,
    },
    //'id', 'customer_id', 'cart_id', 'frequency', 'endDate'
    data(){
        return {
            form: false,
            valid:true,
            editing:false,
            landscape: true, //for date picker
            minDate: new Date().toISOString().slice(0,10),
            addform:{
                customer_id:'',
                cart_id:'',
                frequency:'',
                endDate:new Date().toISOString().slice(0,10),
            },

            search: '',
            headers: [
                //{ text: 'Order Id', value: 'id' },
                {
                    text: 'Recurring Order ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                { text: 'Customer ID', value: 'customer_id' },
                { text: 'Cart ID', value: 'cart_id' },
                { text: 'Frequency', value: 'frequency' },
                { text: 'End Date', value: 'endDate' },

            ],

        }
    },
    computed: {
        formTitle () {
            return this.editing === true ?  'Edit Scheduled Order' : 'New Scheduled Order';
        },
    },
    methods: {
        reset() {
            this.form = false
            this.$refs.addform.reset()
        },
        closeForm(){
            this.$refs.addform.reset();
            this.editing=false;
            this.form = false;
        },
        submit() {
            if(this.$refs.addform.validate()){
                if(!this.editing) {
                    this.$inertia.post('/recurringorder/create', this.addform);
                }else {
                    console.log("Updating....");
                    this.$inertia.patch('/recurringorder/update',this.addform);
                }
                this.closeForm();
                //this.$refs.addform.reset()
                //this.form = false
            }
        },
        editItem:function(item){
            this.editing=true;
            Object.assign(this.addform,item);
            this.form = true;
            //this.$inertia.post('/recurringorder/edit/' + id);
        },
        deleteItem:function(id){
            //Delete the selected entry
            this.$swal({
                title: "Do you want to cancel ?",
                text: "Once cancelled, automated ordering will stop!",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                dangerMode: true,
            }).then((result) =>{
                if(result.isConfirmed){
                    console.log("Deleting....");
                    this.$swal('Operation Successful !');
                    this.$inertia.post('/recurringorder/cancel/' + id);
                }
            });
        }
    }



}
</script>
