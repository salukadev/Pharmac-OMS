<template>
    <Layout title="Returns">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">local_shipping</i>
                                </div>
                                <h4 class="card-title">Delivery Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->


                                    <v-card>

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
                                            :items="deliveries"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{ row.item.order_id }}</td>
                                                    <td>{{ row.item.date }}</td>
                                                    <td>{{ row.item.deliveryStatus }}</td>
                                                    <td><a href="#" @click="openDialog(row.item)">
                                                        <v-icon small color="indigo darken-3">edit</v-icon>
                                                    </a></td>

                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                                <br><br>
                                <div style="text-align: right; padding-right: 20px">
                                    <v-btn color="blue" dark @click="print">
                                        <v-icon dark>book</v-icon>
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


            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centeredgit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLebel">Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


        </v-app>

        <v-dialog v-model="deliveryDialog" persistent
                  max-width="500px">
            <v-card>
                <v-card-title
                    justify="center">
                    <span class="headline" style="text-align: center; padding: 10px">Delivery Status</span>
                </v-card-title>


                <v-card-text>
                    <v-stepper
                        :elevation="0"
                        v-model="level"
                        vertical
                    >
                        <v-stepper-step
                            :complete="level > 1"
                            step="1"
                        >
                            Pending
                        </v-stepper-step>

                        <v-stepper-content step="1">

                            <v-btn
                                color="primary"
                                @click="btProccessing"
                            >
                                Processing
                            </v-btn>


                        </v-stepper-content>

                        <v-stepper-step
                            :complete="level > 2"
                            step="2"
                        >
                            Processing
                        </v-stepper-step>

                        <v-stepper-content step="2">
                            <v-btn
                                color="primary"
                                @click="btShipped"
                            >
                                Shipped
                            </v-btn>

                        </v-stepper-content>

                        <v-stepper-step
                            :complete="level > 3"
                            step="3"
                        >
                            Shipped
                        </v-stepper-step>

                        <v-stepper-content step="3">
                            <v-btn
                                color="primary"
                                @click="btCompleted"
                            >
                                Completed
                            </v-btn>


                        </v-stepper-content>

                        <v-stepper-step step="4">
                            Completed
                        </v-stepper-step>
                    </v-stepper>

                    <div style="text-align: center; padding: 10px">
                        <v-btn
                            class="mr-4"
                            dark
                            color="red darken-3"
                            @click="closeDialog">
                            Close
                        </v-btn>
                        <v-btn
                            dark
                            class="ml-4"
                            color="green lighten-1"
                            @click="update">
                            Update
                        </v-btn>
                    </div>


                </v-card-text>

            </v-card>

        </v-dialog>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'
import {jsPDF} from "jspdf";
import 'jspdf-autotable'

export default {


    el: '#status',

    name: "DeliveryDetails",
    components: {
        Layout,
    },
    props: {
        deliveries: Array,
        delivery: Object,
    },
    data() {
        return {
            level: 1,
            deliveryDialog: false,
            search: '',
            headers: [

                {
                    text: 'Order ID',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                {text: 'Date', value: 'date'},
                {text: 'Delivery Status', value: 'deliveryStatus'},

            ],

            data: {
                order_id: '',
                date: '',
                deliveryStatus: '',
            }

        }
    },
    methods: {
        openDialog(item) {
            switch (item.deliveryStatus) {
                case 'Pending':
                    this.level = 1;
                    break;
                case 'Processing':
                    this.level = 2;
                    break;
                case 'Shipped':
                    this.level = 3;
                    break;
                case 'Completed':
                    this.level = 4;
                    break;
            }
            this.data.order_id = item.order_id
            this.data.date = item.date
            this.data.deliveryStatus = item.deliveryStatus
            this.deliveryDialog = true
            //console.log(item.order_id )
        },

        closeDialog() {
            this.data.order_id = ''
            this.data.date = ''
            this.data.deliveryStatus = ''
            this.deliveryDialog = false
        },

        btProccessing() {
            this.level = 2
            this.data.deliveryStatus = 'Processing'
            console.log(this.data.deliveryStatus)
        },
        btShipped() {
            this.level = 3
            this.data.deliveryStatus = 'Shipped'
            console.log(this.data.deliveryStatus)
        },
        btCompleted() {
            this.level = 4
            this.data.deliveryStatus = 'Completed'
            console.log(this.data.deliveryStatus)
        },

        update() {
            console.log(this.data.deliveryStatus)

            this.$inertia.post('/delivery/update', this.data);

            this.data.order_id = ''
            this.data.date = ''
            this.data.deliveryStatus = ''

            this.deliveryDialog = false
        },

        print () {
            const columns = [
                { title: "Order ID", dataKey: "order_id" },
                { title: "Date", dataKey: "date" },
                { title: "Delivery Status", dataKey: "deliveryStatus" },

            ];
            //pdf format setting
            const doc = new jsPDF('p', 'pt');

            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: Return Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.deliveries
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
            doc.save("DeliveryHistory.pdf");
        },


    }
}
</script>
