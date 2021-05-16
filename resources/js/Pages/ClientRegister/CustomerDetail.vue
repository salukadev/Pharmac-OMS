<template>

        <Layout title = "Customer Details">
            <v-app>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">assignment</i>
                                    </div>
                                    <h4 class="card-title">Customer Management</h4>
                                </div>

                                <div class="card-body">
                                    <div class="toolbar">
                                        <!-- Here you can write extra buttons/actions for the toolbar    -->
                                    </div>

                                    <div class="material-datatables">

                                        <v-card>
                                            <div style="text-align: right; padding: 20px">

                                                <!--goto create complaint method-->


                                                <v-btn color="blue" dark href='/createcustomerDetails'>
                                                    <v-icon dark>add</v-icon>
                                                    Add customer
                                                </v-btn>

                                            </div>


                                            <v-data-table
                                                :headers="headers"
                                                :items="Cus_Details"
                                                :search="search"
                                                class="table-striped table-no-bordered table-hover dataTable"
                                            >
                                                <template v-slot:item="CusDetails">
                                                    <tr>
                                                        <td>{{CusDetails.item.id}}</td>
                                                        <td>{{CusDetails.item.name}}</td>
                                                        <td>{{CusDetails.item.approvalStatus}}</td>
                                                        <td>{{CusDetails.item.telephone}}</td>
                                                        <td>{{CusDetails.item.creditLimit}}</td>
                                                        <td>{{CusDetails.item.agent_id}}</td>
                                                        <td>{{CusDetails.item.user_id }}</td>


                                                        <!--goto edit complaint method using a button-->
                                                        <td>
                                                            <v-btn color="green" dark @click='edit(CusDetails.item)'>
                                                                <v-icon dark>mdi-pencil</v-icon>
                                                            </v-btn>
                                                        </td>

                                                        <!--goto delete complaint method using a button-->
                                                        <td>
                                                            <v-btn color="red" dark @click="deleteCustomerDetails(CusDetails.item.id)">
                                                                <v-icon dark>delete</v-icon>
                                                            </v-btn>
                                                        </td>

                                                    </tr>
                                                </template>
                                            </v-data-table>
                                        </v-card>

                                    </div>
                                    <br><br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </v-app>


        </Layout>

</template>

<script>
import Layout from "../../Shared/Admin/Layout";

export default {
    name: "ClientRegisterForm",
    components:{
        Layout,
    },
    props:['Cus_Details'],

    data(){
        return {
            search: '',

            // make the header of the table
            headers: [

                {
                    text: 'Customer ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                { text: 'Name', value: 'name' },
                { text: 'Approval Status', value: 'approvalStatus' },
                { text: 'Telephone N', value: 'telephone' },
                { text: 'Credit Limit', value: 'creditLimit' },
                { text: 'Agent ID', value: 'agent_id' },
                { text: 'User ID', value: 'User_id' },

            ],

        }


    },

    methods:{

        edit:function(data){
            this.$inertia.post('/editCustomerDetails', data)
        },

        deleteCustomerDetails:function(CusDetails){
            this.$inertia.post('/deleteCustomerDetails/'+ CusDetails)
        },


    }
}
</script>

<style scoped>

</style>
