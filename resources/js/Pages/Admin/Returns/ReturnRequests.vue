<template>
    <Layout title="Returns">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Return Management</h4>
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
                                            :items="product_returns"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{ row.item.order_id }}</td>
                                                    <td>{{ row.item.reason }}</td>
                                                    <td>{{ row.item.remark }}</td>
                                                    <td>{{ row.item.type }}</td>
                                                    <td>{{ row.item.returnStatus }}</td>
                                                    <td>
                                                        <a href="#" @click="openDialog(row.item)">
                                                            <v-icon medium color="indigo darken-3">
                                                                mdi-checkbox-marked-circle
                                                            </v-icon>
                                                        </a>
                                                        <a href="#" @click="btrejected(row.item)">
                                                            <v-icon medium color="red darken-3">mdi-cancel</v-icon>
                                                        </a>
                                                    </td>

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


        <v-dialog v-model="returnDialog" persistent
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
                                @click="btCompleted"
                            >
                                Completed
                            </v-btn>

                        </v-stepper-content>

                        <v-stepper-step step="3">
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
                            Confirm
                        </v-btn>
                    </div>


                </v-card-text>

            </v-card>

        </v-dialog>
        <v-dialog v-model="rejectDialog" persistent
                  max-width="310px">
            <v-card>
                <v-card-title
                    justify="center">
                    <span class="headline" style="text-align: center; padding: 10px"> Are you sure you want<br>
                        to reject this request?<br></span>
                </v-card-title>
                <div style="text-align: center; padding: 10px">
                    <v-textarea
                        v-model="rejectRemark"
                        name="input-7-1"
                        filled
                        label="Remark"
                        auto-grow
                    ></v-textarea>
                </div>
                <v-card-text>
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
                            Confirm
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
    name: "ReturnDetails",

    components: {
        Layout,
    },
    props: {
        product_returns: Array,
        product_return: Object,
    },
    data() {
        return {
            level: 1,
            returnDialog: false,
            rejectDialog: false,

            rejectRemark:'',
            search: '',
            headers: [

                {
                    text: 'Order ID',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                {text: 'Reason', value: 'reason'},
                {text: 'Remark', value: 'remark'},
                {text: 'Type', value: 'type'},
                {text: 'Status', value: 'returnStatus'},

            ],

            data: {
                order_id: '',
                reason: '',
                remark: '',
                type: '',
                returnStatus: '',
            }

        }
    },
    methods: {
        openDialog(item) {
            if (item.returnStatus != 'rejected') {
                switch (item.returnStatus) {
                    case 'pending':
                        this.level = 1;
                        break;
                    case 'processing':
                        this.level = 2;
                        break;
                    case 'completed':
                        this.level = 3;
                        break;
                }
                this.data.order_id = item.order_id
                this.data.reason = item.reason
                this.data.remark = item.remark
                this.data.type = item.type

                this.returnDialog = true
                console.log(item.order_id)
            }
        },

        closeDialog() {
            this.data.order_id = ''
            this.data.reason = ''
            this.data.remark = ''
            this.data.type = ''
            this.data.returnStatus = ''

            this.returnDialog = false
            this.rejectDialog = false
        },

        btProccessing() {
            this.level = 2
            this.data.returnStatus = 'processing'
            console.log(this.data.returnStatus)
            //console.log(1)
        },

        btCompleted() {
            this.level = 3
            this.data.returnStatus = 'completed'
        },

        btrejected(item) {
            if (item.returnStatus == 'pending') {
                this.level = 0
                this.data.order_id = item.order_id
                this.data.reason = item.reason
                this.data.remark = this.rejectRemark
                this.data.type = item.type
                this.data.returnStatus = 'rejected'
                this.rejectDialog = true
            }
        },

        update() {
            console.log(this.data.returnStatus)
            this.$inertia.post('/return/update', this.data);

            this.data.order_id = ''
            this.data.reason = ''
            this.data.remark = ''
            this.data.type = ''
            this.data.returnStatus = ''

            this.returnDialog = false
            this.rejectDialog = false
        },

        print () {
            console.log(this.product_returns);
            const columns = [
                { title: "Order ID", dataKey: "order_id" },
                { title: "Reason", dataKey: "reason" },
                { title: "Remark", dataKey: "remark" },
                { title: "Type", dataKey: "type" },
                { title: "Return Status", dataKey: "returnStatus" },

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
                body: this.product_returns
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
            doc.save("ReturnHistory.pdf");
        },
    }
}
</script>
