<template>
    <Layout>
        <v-app id="inspire">
            <div>
                <h3 align="center">Welcome TO Pharmac OMS</h3>
                <v-card class="mt-5 mb-8">
                    <v-card-text>
                        <v-container pa-0>
                            <v-row >
                                <v-col>
                                    <v-card  width="50%" max-height="200px">
                                        <v-card-text>
                                            <div >
                                                <h3 class="mt-1  ">Community Growth</h3>
                                            </div>
                                            <v-row>
                                                <v-icon x-large class="mb-2 ml-15">
                                                    trending_up
                                                </v-icon>

                                                <div class="ml-5">
                                                    <h2>56%</h2>
                                                </div>
                                            </v-row>
                                        </v-card-text>


                                    </v-card>
                                </v-col>
                                <v-col>
                                    <v-card  width="50%" max-height="200px">
                                        <v-card-text>
                                            <div >
                                                <h3 class="mt-1  ">Business Expansion</h3>
                                            </div>
                                            <v-row>
                                                <v-icon x-large class="mb-2 ml-15">
                                                    account_balance
                                                </v-icon>

                                                <div class="ml-5">
                                                    <h2>06%</h2>
                                                </div>
                                            </v-row>
                                        </v-card-text>


                                    </v-card>
                                </v-col>
                                <v-col>
                                    <v-card  width="50%" max-height="200px">
                                        <v-card-text>
                                            <div >
                                                <h3 class="mt-1  ">Sales Growth</h3>
                                            </div>
                                            <v-row>
                                                <v-icon x-large class="mb-2 ml-15">
                                                    trending_up
                                                </v-icon>

                                                <div class="ml-5">
                                                    <h2>15%</h2>
                                                </div>
                                            </v-row>
                                        </v-card-text>


                                    </v-card>
                                </v-col>
                            </v-row>
                            <v-row>
                                <h3 align="center">Order Statistics</h3>
                                <bar-chart :chart-data="datacollection" class="m-5" width="600px"></bar-chart>
                            </v-row>
                            <v-row dense>
                                <v-col cols="12">
                                    <v-card
                                        class="pa-2"

                                        tile
                                    >
                                        <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Registration Requests
                                                    </p>
                                                    <p>NEW REGISTRATIONS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>

                            </v-row>
                            <v-row>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Product Requests
                                                    </p>
                                                    <p>NEW PHARMACEUTICAL REQUESTS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/productRequestsAll">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"

                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>
                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Agents
                                                    </p>
                                                    <p>ALL AGENTS DETAILS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/agentDetails">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Customers
                                                    </p>
                                                    <p>ALL REGISTERED CUSTOMERS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/CustomerDetails">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                            </v-row>
                            <!--third Row-->
                            <v-row>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Stock
                                                    </p>
                                                    <p>PHARMACEUTICAL PRODUCT STOCKS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/stock">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>
                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Complaints
                                                    </p>
                                                    <p>CUSTOMER COMPLAINTS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/complaint">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="4">
                                    <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                    >
                                        <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Products
                                                    </p>
                                                    <p>PRODUCTS LISTED</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <inertia-link href="/list">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                    </inertia-link>
                                                </v-card-actions>

                                            </v-card>
                                        </div>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>
            </div>
        </v-app>
    </Layout>
</template>

<script>
import Layout from "../Shared/Admin/Layout";
import LineChart from "./Charts/LineChart";
import BarChart from "./Charts/BarChart";
export default {
    components:{
      Layout,
      LineChart,
      BarChart
    },
    props:['amounts'],
    data(){
        return{
            datacollection:null
        }
    },
    mounted() {
        this.datacollection = {
            labels:[],
            datasets:[
                {
                    label: 'Orders',
                    backgroundColor: '#3bbcbc',
                    data: []
                }
            ]
        }
        for (let i = 0 ; i < this.amounts.length ; i++){
            this.datacollection.datasets[0].data.push(this.amounts[i].amount);
            this.datacollection.labels.push(this.amounts[i].updated_at);
        }
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Custom Chart Title'
            }
        }
    }
}
</script>
