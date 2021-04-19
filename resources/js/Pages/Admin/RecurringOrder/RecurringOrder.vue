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
                                            <div style="text-align: right; padding: 20px">
                                                <v-row class="d-flex justify-end mb-6">
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
                                                                Add Order
                                                            </v-btn>
                                                        </template>
                                                        <v-card>
                                                            <v-card-title>
                                                                <span class="headline">Supplier Details</span>
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
                                                                        :items="items_cust"
                                                                        :rules="[v => !!v || 'Customer ID is required']"
                                                                        label="Customer ID"
                                                                        required
                                                                    ></v-select>

                                                                        <v-select
                                                                            v-model="addform.cart_id"
                                                                            :items="items_cart"
                                                                            :rules="[v => !!v || 'Order ID is required']"
                                                                            label="Order ID"
                                                                            required
                                                                        ></v-select>

                                                                        <v-text-field
                                                                            label="Frequency (Days)"
                                                                            v-model="addform.frequency"
                                                                            :counter="255"
                                                                            :rules="[v => !!v || 'Frequency is required']"
                                                                            required
                                                                        ></v-text-field>

                                                                        <v-col
                                                                            cols="12"
                                                                            sm="6"
                                                                            class="my-2 px-1"
                                                                        >
                                                                            <v-date-picker
                                                                                ref="picker"
                                                                                v-model="date"
                                                                                :picker-date.sync="pickerDate"
                                                                                full-width
                                                                            ></v-date-picker>
                                                                        </v-col>


                                                                        <v-btn
                                                                            color="error"
                                                                            class="mr-4"
                                                                            @click="reset"
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
                                                </v-row>

                                            </div>

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
                                                        <v-btn color="indigo darken-4" icon @click="edit(row.item)">
                                                            <v-icon dark>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>
                                                    <td>
                                                        <v-btn color="red darken-3" icon  @click="deleteAgent(row.item.id)">
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
    },
    //'id', 'customer_id', 'cart_id', 'frequency', 'endDate'
    data(){
        return {
            form: false,
            valid:true,

            items_cust: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4',
            ],
            items_cart: [
                'Item cart1',
                'Item cart2',
                'Item cart3',
                'Item cart4',
            ],

            addform:{
                supName:'',
                email:'',
                address:'',
                telephone:'',
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

    methods: {
        reset() {
            this.form = false
            this.$refs.addform.reset()
        },
        submit() {
            this.$inertia.post('/supplier/store', this.addform);
            this.$refs.addform.reset()
            this.form = false
        },
    }



}
</script>
