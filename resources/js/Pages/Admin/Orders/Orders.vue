<template>
    <Layout title="Orders">
<v-app>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Order Management</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <!-- DATATABLE-->
                            <v-card>
                                <v-card-title>New orders</v-card-title>

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
                                :items="orders"
                                :search="search"
                                class="table-striped table-no-bordered table-hover dataTable"
                            >
<!--                                <template v-slot:item.glutenfree="{ item }">
                                    <v-simple-checkbox v-model="item.glutenfree" disabled></v-simple-checkbox>
                                </template>-->
                                <template v-slot:item="row">
                                    <tr>
                                        <td>{{row.item.id}}</td>
                                        <td>{{row.item.user_id}}</td>
                                        <td>{{row.item.amount}}</td>
                                        <td>{{row.item.created_at}}</td>
                                        <td>
                                            <div class="row">
                                            <v-btn small depressed color="green" dark @click="accept(row.item.id)">
                                                Accept
                                            </v-btn>

                                            <div class="ml-2">
                                            <v-btn  small depressed color="red" dark @click="reject(row.item.id)">
                                                Reject
                                            </v-btn>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                            </v-card>
                        </div>
                        <br>
                        <br>
                        <div class="material-datatables">
                            <!-- DATATABLE-->
                            <v-card>
                                <v-card-title>All orders</v-card-title>

                                <v-card-title>
                                    <v-text-field
                                        v-model="search2"
                                        append-icon="search"
                                        label="Search"
                                        single-line
                                        hide-details
                                    ></v-text-field>
                                </v-card-title>

                                <v-data-table
                                    :headers="headers2"
                                    :items="orders"
                                    :search="search"
                                    class="table-striped table-no-bordered table-hover dataTable"
                                >
                                <!--
                                    <template v-slot:item.glutenfree="{ item }">
                                        <v-simple-checkbox v-model="item.glutenfree" disabled></v-simple-checkbox>
                                    </template> -->

                                </v-data-table>
                            </v-card>
                        </div>
                        <br><br>
                        <div style="text-align: right; padding-right: 20px">
                            <v-btn color="blue" dark @click="print">
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
import {jsPDF} from "jspdf";
import 'jspdf-autotable'

export default {
    name: "Orders",
    mounted:function(){
        //this.$swal('Hello World !!!');
    },
    components:{
        Layout,
    },
    props:{
        orders:Array,
    },
    methods: {
        reject: function (id) {
            //Delete the selected entry
            this.status.id = id;
            this.status.status = "Rejected";
            this.$swal({
                title: "Do you want to reject ?",
                text: "Order will be rejected !",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Deleting....");
                    this.$swal('Operation Successful !');
                    //this.$inertia.delete('/orders/' + id);
                }
            });
        },
        accept:function(id){
            this.status.id = id;
            console.log(id);
            this.status.status = "Processing";
            this.$swal({
                title: "Do you want to proceed ?",
                text: "Order will be accepted !",

                buttons: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Deleting....");
                    this.$swal('Operation Successful !');
                    //this.$inertia.delete('/orders/' + id);
                }
            });
        },
        print () {
            const columns = [
                { title: "ID", dataKey: "id" },
                { title: "Order type", dataKey: "type" },
                { title: "Amount", dataKey: "amount" },
                { title: "Status", dataKey: "status" },
                { title: "Order date", dataKey: "created_at" }

            ];
            //pdf format setting
            const doc = new jsPDF('p', 'pt');
            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);
            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);
            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);
            doc.setFontSize(13).text("Report: All Order Details", 50, 120);
            doc.setFontSize(10).text("Generated on : " + new Date(), 240, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.orders
            });

            doc.setLineWidth(0.01).line(0.5, doc.internal.pageSize.height - 40, 1200, doc.internal.pageSize.height - 40);

            // Creating footer and saving file
            doc
                .setFont("times")
                .setFontSize(11)
                .setTextColor(0, 0, 255)
                .text(
                    "@2021 Pharmac(PVT).Ltd",
                    20,
                    doc.internal.pageSize.height - 20
                );
            doc.save("Orders.pdf");
        },
    },
    data(){
        return {
            search: '',
            search2:'',
            status:{
              status:'Rejected',
              id:'' ,
            },
            headers: [
                { text: 'Id', value: 'id' },
                { text: 'Cus. Id', value: 'customer_id' },
                { text: 'Amount', value: 'amount' },
                { text: 'Placed on', value: 'created_at' },
                { text: '', value: 'name', sortable: false }
            ],
            headers2: [
                { text: 'Id', value: 'id' },
                {
                    text: 'Customer',
                    align: 'start',
                    sortable: false,
                    value: 'customer.name',
                },

                { text: 'Order Type', value: 'type' },
                { text: 'Amount', value: 'amount' },
                { text: 'Status', value: 'status' },
                { text: 'Placed on', value: 'created_at' },
            ],

        }
    }
}
</script>

<style scoped>

</style>
