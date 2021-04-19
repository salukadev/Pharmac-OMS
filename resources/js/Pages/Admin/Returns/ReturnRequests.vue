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
                                                    <td>{{row.item.order_id}}</td>
                                                    <td>{{row.item.reason}}</td>
                                                    <td>{{row.item.remark}} <v-icon small color="blue lighten-1">edit</v-icon> </td>
                                                    <td>{{row.item.type}}</td>
                                                    <td>{{row.item.returnStatus}} <v-icon small color="green lighten-1">edit</v-icon> </td>
                                                    <!--
                                                    <td>
                                                        <v-btn
                                                            color="indigo darken-4"
                                                            icon>
                                                            <v-icon>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>
                                                    <td>
                                                        <v-btn
                                                            color="red darken-4"
                                                            icon>
                                                            <v-icon>delete</v-icon>
                                                        </v-btn>
                                                    </td>   -->
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
    name: "ReturnDetails",
    components:{
        Layout,
    },
    props:{
        product_returns:Array,
        product_return: Object,
    },
    data(){
        return {
            search: '',
            headers: [

                {
                    text: 'Order ID',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                { text: 'Reason', value: 'reason' },
                { text: 'Remark', value: 'remark' },
                { text: 'Type', value: 'type' },
                { text: 'Status', value: 'returnStatus' },

            ],

        }
    },
    methods:{


    }
}
</script>
