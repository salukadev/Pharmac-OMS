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
                                                <h2>1063200.00</h2>
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
                                                <h2>1063200.00</h2>
                                            </div>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                            </v-card>
                        </v-card>
                        <v-row class="d-flex pa-2 justify-center" >
                            <bar-chart :chart-data="datacollection" class="m-5" width="600px"></bar-chart>
                        </v-row>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>

                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                               
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
            </v-card>
        </Layout>
    </v-app>
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
                    label: 'Data One',
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
<style scoped>

</style>
