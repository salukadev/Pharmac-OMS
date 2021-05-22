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
                                                    <td><a href="#" @click="openDialog(row.item)">
                                                        <v-icon small color="green lighten-1">edit</v-icon>
                                                    </a></td>

                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                                <br><br>
                                <div style="text-align: right; padding-right: 20px">
                                    <v-btn color="blue" dark href="">
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
                            <small v-model='dt1'>2021-01-12</small>
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
                            <small v-model='dt2'>2021-01-15</small>
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
                            <small v-model='dt4'>2021-01-15</small>
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
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

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
            if (item.returnStatus != 'Rejected') {
                switch (item.deliveryStatus) {
                    case 'Pending':
                        this.level = 1;
                        break;
                    case 'Processing':
                        this.level = 2;
                        break;
                    case 'Completed':
                        this.level = 3;
                        break;
                }

                this.returnDialog = true
                //console.log(item.order_id )
            }
        },

        closeDialog() {
            this.data.order_id = ''
            this.data.reason = ''
            this.data.remark = ''
            this.data.type = ''
            this.data.returnStatus = ''

            this.returnDialog = false
        },

        btProccessing() {
            this.level = 2
            this.data.returnStatus = 'Processing'
            console.log(this.data.deliveryStatus)
        },

        btCompleted() {
            this.level = 3
            this.data.returnStatus = 'Completed'
            console.log(this.data.deliveryStatus)
        },

        btrejected() {
            this.level = 4
            this.data.deliveryStatus = 'Rejected'
            console.log(this.data.deliveryStatus)
        },

        update() {
            console.log(this.data.deliveryStatus)

            this.$inertia.post('/delivery/update', this.data);

            this.data.order_id = ''
            this.data.date = ''
            this.data.deliveryStatus = ''

            this.deliveryDialog = false
        }

    }
}
</script>
