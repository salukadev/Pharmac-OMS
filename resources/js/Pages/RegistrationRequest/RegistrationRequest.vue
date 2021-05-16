<template>
    <Layout title = "Registration Requests">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Registration Requests Management</h4>
                            </div>

                            <div class="card-body">
                                <div class="toolbar">
                                     <!-- Here you can write extra buttons/actions for the toolbar    -->
                                </div>

                                <div class="material-datatables">

                                    <v-card>
                                        <div style="text-align: right; padding: 20px">

                                            <!--goto create complaint method-->

                                            <v-btn color="blue" dark href='/create_request'>
                                                <v-icon dark>add</v-icon>
                                                Add Request
                                            </v-btn>

                                            <v-btn color="blue" dark href='/displayCustomers'>
                                                <v-icon dark>add</v-icon>
                                                Add customer
                                            </v-btn>

                                        </div>


                                        <v-data-table
                                            :headers="headers"
                                            :items="Reg_Details"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="RegDetails">
                                                <tr>
                                                    <td>{{RegDetails.item.requestId}}</td>
                                                    <td>{{RegDetails.item.name}}</td>
                                                    <td>{{RegDetails.item.address}}</td>
                                                    <td>{{RegDetails.item.cusType}}</td>
                                                    <td>{{RegDetails.item.telephone}}</td>
                                                    <td>{{RegDetails.item.status}}</td>


                                                    <!--goto edit complaint method using a button-->
                                                    <td>
                                                        <v-btn color="green" dark @click='edit(RegDetails.item)'>
                                                            <v-icon dark>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>

                                                    <!--goto delete complaint method using a button-->
                                                    <td>
                                                        <v-btn color="red" dark @click="deleteRegistrationRequest(RegDetails.item.requestId)">
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


                                    <v-btn color="blue" dark @click="print">
                                        <v-icon  dark>book</v-icon>
                                        Generate Report
                                    </v-btn>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </v-app>


    </Layout>

</template>

<script>

import Layout from '../../Shared/Admin/Layout'
import {jsPDF} from "jspdf";

export default {
    name:'RegistrationRequest',
    components:{
        Layout,
    },
    props:['Reg_Details'],

    data(){
        return {
            search: '',

            // make the header of the table
            headers: [

                {
                    text: 'Request ID',
                    align: 'start',
                    sortable: false,
                    value: 'requestId',
                },

                { text: 'Name', value: 'name' },
                { text: 'Address', value: 'address' },
                { text: 'Customer Type', value: 'cusType' },
                { text: 'Telephone Number', value: 'telephone' },
                { text: 'Status', value: 'status' },

            ],

        }


    },


    methods:{

        edit:function(data){
            this.$inertia.post('/editRegistrationRequest', data)
        },

        deleteRegistrationRequest:function(RegDetails){
            this.$inertia.post('/deleteRegistrationRequest/'+ RegDetails)
        },


        print () {

            const columns = [
                { title: "RequestID", dataKey: "requestId" },
                { title: "Name", dataKey: "name" },
                { title: "Customer Type", dataKey: "cusType" },
                { title: "Telephone", dataKey: "telephone" },
                { title: "Status", dataKey: "status" }


            ];
            const doc = new jsPDF('p', 'pt'
                //orientation: "portrait",
                //unit: "in",
                //format: "letter"
            );

            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All Requests Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.Reg_Details
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
            doc.save("AllRequests.pdf");
        },
    }

}
</script>
