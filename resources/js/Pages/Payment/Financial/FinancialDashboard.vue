<template>
    <v-app>
        <Layout>
            <v-card>
                <v-toolbar
                    flat
                    color="primary"
                    dark
                >
                    <v-toolbar-title>Financial Management</v-toolbar-title>
                </v-toolbar>
                <v-tabs vertical >
                    <v-tab >
                        <v-icon left>
                            price_change
                        </v-icon>
                        Cheque Management
                    </v-tab>
                    <v-tab >
                        <v-icon left>
                            summarize
                        </v-icon>
                        Finance & Reports
                    </v-tab>
                    <v-tab >
                        <v-icon left>
                            speed
                        </v-icon>
                        Performance
                    </v-tab>
                    <v-tab-item>
                        <v-card flat>

                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <div>
                            <h2 class="text-center grey--text text--accent-1 font-weight-bold ">30 Days Progress</h2>
                        </div>
                        <v-card flat>
                            <v-card
                            max-width="98%"
                            outlined
                            max-height="200px"
                            min-height="200px"
                            class="d-flex justify-space-between align-items-center"
                            >

                                <v-card  width="20%" max-height="100px" class="ml-8">

                                    <v-card-text>
                                        <div >
                                            <h3 class="mt-1  font-weight-bold ">Income</h3>
                                        </div>
                                        <v-row>
                                            <v-icon x-large class="mb-2 ml-5">
                                                monetization_on
                                            </v-icon>

                                            <div class="">
                                                <h2>{{oneTimeAmount[0].amount + oneTimeAmount[1].amount}}.00</h2>
                                            </div>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                                <v-card  width="20%" max-height="100px">
                                    <v-card-text>
                                        <div >
                                            <h3 class="mt-1  font-weight-bold ">Sales</h3>
                                        </div>
                                        <v-row>
                                            <v-icon x-large class="mb-2 ml-15">
                                                trending_up
                                            </v-icon>

                                            <div class="ml-5">
                                                <h2>66%</h2>
                                            </div>
                                        </v-row>
                                    </v-card-text>


                                </v-card>

                                <v-card  width="20%" max-height="100px" class="mr-8">
                                    <v-card-text>
                                        <div >
                                            <h3 class="mt-1  font-weight-bold ">Total Pending</h3>
                                        </div>
                                        <v-row>
                                            <v-icon x-large class="mb-2 ml-5">
                                                account_balance
                                            </v-icon>

                                            <div class="">
                                                <h2>{{pendingAmount[0].amount}}.00</h2>
                                            </div>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                            </v-card>
                        </v-card>
                        <v-card
                            max-width="98%"
                            elevation="0">

                            <h5 class="text-center grey--text text--accent-1 font-weight-bold mt-5">Financial Progress</h5>
                            <v-row class="d-flex pa-2 justify-center" >
                                <BarChart :chart-data="datacollection"  width="600px"></BarChart>
                            </v-row>
                        </v-card>
                        <v-card
                            max-width="98%"
                            outlined
                            class="mt-5">
                            <h3 class="text-center grey--text text--accent-1 font-weight-bold " style="font-size: xxx-large">Reports</h3>

                            <v-card
                                width="100%"
                                class="d-flex justify-space-between align-items-center" elevation="0">
                                <v-card width="370px" height="500px" class="m-5">
                                    <LineChart :chart-data="reportCheque" width="250px" height="150px" class="p-4"></LineChart>
                                    <v-row no-gutters>
                                        <v-col
                                            cols="12"
                                            sm="7"
                                        >
                                            <v-card
                                                class="pa-2"
                                                elevation="0"
                                            >

                                                <div class="grey--text mb-2">
                                                    You Can Easily Generate Report according to the time period by clicking Download.Also You can View the Report by clicking View button
                                                </div>

                                            </v-card>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="5"
                                        >
                                            <v-card
                                                elevation="0"
                                                tile
                                            >
                                                <PirChart :chart-data="reportChequePie"  ></PirChart>

                                            </v-card>
                                        </v-col>
                                    </v-row>
                                    <v-row  justify="center"
                                            no-gutters>
                                        <v-btn
                                            color="primary"
                                            dark
                                            @click="printCheque()"
                                        >
                                           Download
                                        </v-btn>
                                    </v-row>
                                </v-card>
                                <v-card width="370px" height="500px" >
                                    <line-chart :chart-data="reportFin" width="250px" height="150px" class="p-4"></line-chart>

                                </v-card>
                                <v-card width="370px" height="500px" class="m-5">
                                    <LineChart :chart-data="reportPay" width="250px" height="150px" class="p-4"></LineChart>
                                    <v-row no-gutters>
                                        <v-col
                                            cols="12"
                                            sm="7"
                                        >
                                            <v-card
                                                class="pa-2"
                                                elevation="0"
                                                tile
                                            >

                                                <div class="grey--text mb-2">
                                                    You Can Easily Generate Report according to the time period by clicking Download.Also You can View the Report by clicking View button
                                                </div>

                                            </v-card>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="5"
                                        >
                                            <v-card
                                                elevation="0"
                                                tile
                                            >
                                                <PirChart :chart-data="reportPayPie"  ></PirChart>

                                            </v-card>
                                        </v-col>
                                    </v-row>
                                    <v-row  justify="center"
                                            no-gutters>

                                        <v-btn
                                            color="primary"
                                            dark
                                            @click="printPayment()"
                                        >
                                            Download
                                        </v-btn>
                                    </v-row>

                                </v-card>
                            </v-card>

                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <div class="card">
                                <div class="card-header card-header-warning card-header-icon">

                                    <div class="card-icon">

                                        <i class="material-icons">request_quote</i>
                                    </div>
                                    <h4 class="card-title">Agent Performance</h4>
                                    <v-card class="mt-3 mb-3">
                                        <v-alert
                                            dense
                                            text
                                            type="success"
                                            v-if="successMessage"
                                        >
                                            {{successMessage}}
                                        </v-alert>
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
                                            :items="agentPerform"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="agent">
                                                <!--display data-->
                                                <tr>
                                                    <td>{{ agent.item.agent_id }}</td>
                                                    <td>{{ agent.item.amount }}</td>
                                                    <td>
                                                        <v-btn color="primary" dark @click="display(cheque.item)">
                                                            View
                                                        </v-btn>
                                                        <v-btn color="success" dark @click="accept(cheque.item)">
                                                            Remove
                                                        </v-btn>
                                                    </td>

                                                </tr><!-- end of display data-->
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header card-header-warning card-header-icon">

                                    <div class="card-icon">

                                        <i class="material-icons">request_quote</i>
                                    </div>
                                    <h4 class="card-title">Customer Performance</h4>
                                    <v-card class="mt-3 mb-3">
                                        <v-alert
                                            dense
                                            text
                                            type="success"
                                            v-if="successMessage"
                                        >
                                            {{successMessage}}
                                        </v-alert>
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
                                            :items="customerPerform"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="cus">
                                                <!--display data-->
                                                <tr>
                                                    <td>{{ cus.item.id }}</td>
                                                    <td>{{ cus.item.amount }}</td>
                                                    <td>
                                                        <v-btn color="primary" dark @click="display(cheque.item)">
                                                            View
                                                        </v-btn>
                                                        <v-btn color="success" dark @click="accept(cheque.item)">
                                                            Remove
                                                        </v-btn>
                                                    </td>

                                                </tr><!-- end of display data-->
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                            </div>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
            </v-card>
        </Layout>
    </v-app>
</template>

<script>
import OpenModelReport from "./OpenModelReport";
import Layout from "../../../Shared/Admin/Layout";
import LineChart from "../../Charts/LineChart";
import BarChart from "../../Charts/BarChart";
import PirChart from "../../Charts/PirChart";
import {jsPDF} from "jspdf";
import 'jspdf-autotable'
export default {
    components:{
        OpenModelReport,
        Layout,
        LineChart,
        BarChart,
        PirChart,
    },
    props:[
        'amounts',
        'acceptCheque',
        'rejectCheque',
        'pendingCheque',
        'oneTimeAmount',
        'dailyPayments',
        'orderSales',
        'stocksPrices',
        'pendingAmount',
        'chequeReport',
        'customerPerform',
        'agentPerform'
    ],
    data(){
        return{
            search: '',
            expanded: [],
            singleExpand: false,
            headers: [
                {
                    text: 'User Id',
                    align: 'start',
                    sortable: false,
                    value: 'id'
                },
                {text: 'Amount', value: 'amount'},
            ],
            datacollection:null,
            reportCheque:null,
            reportFin:null,
            reportPay:null,
            reportChequePie:null,
            reportPayPie:null,
        }
    },
    mounted() {
        this.dataCol();
        this.reportChq();
        this.reportChqPie();
        this.reportFinancial();
        this.reportPayment();
        this.reportPaymentPie();
    },
    methods:{
        dataCol(){
            this.datacollection = {
                labels:[],
                datasets:[
                    {
                        label: 'Sales Profits',
                        backgroundColor: '#3bbcbc',
                        data: []
                    }
                ]
            }

            for (let i = 0 ; i < this.amounts.length ; i++){
                this.datacollection.datasets[0].data.push(this.orderSales[i].amount);
                this.datacollection.labels.push(this.orderSales[i].new_date);
            }

        },
        reportChq(){
            this.reportCheque = {
                labels:[],
                datasets:[
                    {
                        label: 'Cheques',
                        backgroundColor: '#3bbcbc',
                        data: []
                    }
                ]
            }
            for (let i = 0 ; i < this.amounts.length ; i++){
                this.reportCheque.datasets[0].data.push(this.amounts[i].amount);
                this.reportCheque.labels.push(this.amounts[i].new_date);
            }
        },
        reportChqPie(){
            this.reportChequePie = {
                labels:["Accepted","Rejected","Pending"],
                datasets:[
                    {
                        label: 'Cheques',
                        backgroundColor: ["#0074D9", "#FF4136", "#2ECC40"],
                        data: [this.acceptCheque,this.rejectCheque,this.pendingCheque]
                    },

                ]
            }
        },
        reportFinancial(){
            this.reportFin = {
                labels:[],
                datasets:[
                    {
                        label: 'Financial',
                        backgroundColor:'#3bbcbc',
                        data: []
                    }
                ]
            }
            for (let i = 0 ; i < this.amounts.length ; i++){
                this.reportFin.datasets[0].data.push(this.amounts[i].amount);
                this.reportFin.labels.push(this.amounts[i].amount);
            }
        },
        reportPayment(){
            this.reportPay = {
                labels:[],
                datasets:[
                    {
                        label: 'Payments',
                        backgroundColor:'#3bbcbc',
                        data: []
                    }
                ]
            }
            for (let i = 0 ; i < this.dailyPayments.length ; i++){
                this.reportPay.datasets[0].data.push(this.dailyPayments[i].amount);
                this.reportPay.labels.push(this.dailyPayments[i].new_date);
            }
        },
        reportPaymentPie(){
            this.reportPayPie = {
                labels:[],
                datasets:[
                    {
                        label: 'Cheques',
                        backgroundColor: ["#0074D9", "#2ECC40"],
                        data: []
                    },

                ]
            }
            for (let i = 0 ; i < this.oneTimeAmount.length ; i++){
                this.reportPayPie.datasets[0].data.push(this.oneTimeAmount[i].amount);
                this.reportPayPie.labels.push(this.oneTimeAmount[i].payment_Type);
            }
        },
        printCheque(){
                const columns = [
                    { title: "CHEQUE NO", dataKey: "chequeNo" },
                    { title: "PAYMENT ID", dataKey: "payment_id" },
                    { title: "ORDER ID", dataKey: "order_id" },
                    { title: "AMOUNT", dataKey: "amount" },
                    { title: "UPLOAD DATE", dataKey: "created_at" },
                    { title: "AGENT ID", dataKey: "agent_id" },
                    { title: "CHEQUE DATE", dataKey: "date" },
                    { title: "ACTION", dataKey: "status" },
                    { title: "HANDLED BY", dataKey: "admin_id" },
                    { title: "ACTION TIME", dataKey: "updated_at" }

                ];
                const doc = new jsPDF('landscape', 'pt','a4'

                );
                doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

                doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

                doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
                // create a line under heading
                doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

                doc.setFontSize(13).text("Report: All Cheques Details", 50, 120);

                doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
                // Using autoTable plugin
                doc.autoTable({
                    margin: { top: 130 },
                    columns,
                    body: this.chequeReport
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
                doc.save("ChequeReport"+new Date()+".pdf");
            },
        printPayment(){
            const columns = [
                { title: "CHEQUE NO", dataKey: "chequeNo" },
                { title: "PAYMENT ID", dataKey: "payment_id" },
                { title: "ORDER ID", dataKey: "order_id" },
                { title: "AMOUNT", dataKey: "amount" },
                { title: "UPLOAD DATE", dataKey: "created_at" },
                { title: "AGENT ID", dataKey: "agent_id" },
                { title: "CHEQUE DATE", dataKey: "date" },
                { title: "ACTION", dataKey: "status" },
                { title: "HANDLED BY", dataKey: "admin_id" },
                { title: "ACTION TIME", dataKey: "updated_at" }

            ];
            const doc = new jsPDF('landscape', 'pt','a4'

            );
            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All Cheques Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.chequeReport
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
            doc.save("ChequeReport"+new Date()+".pdf");
        }
        }



}
</script>
<style scoped>

</style>
