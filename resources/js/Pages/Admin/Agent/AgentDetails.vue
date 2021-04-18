<template>
    <Layout title="Agents">
        <v-app>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Agent Management</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>

                            <div class="material-datatables">
                                <!-- DATATABLE-->


                                <v-card>
                                    <div style="text-align: right; padding: 20px">
                                        <v-btn color="blue" dark href="/agentDetails/add">
                                            <v-icon dark>add</v-icon>
                                            Add Agent
                                        </v-btn>
                                    </div>
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
                                        :items="agents"
                                        :search="search"
                                        class="table-striped table-no-bordered table-hover dataTable"
                                    >
                                        <template v-slot:item="row">
                                            <tr>
                                                <td>{{row.item.id}}</td>
                                                <td>{{row.item.email}}</td>
                                                <td>{{row.item.userName}}</td>
                                                <td>{{row.item.name}}</td>
                                                <td>{{row.item.telephone}}</td>
                                                <td>{{row.item.NIC}}</td>
                                                <td>
                                                    <v-btn color="green" dark @click="edit(row.item)">
                                                        <v-icon dark>build</v-icon>
                                                    </v-btn>
                                                </td>
                                                <td>
                                                    <v-btn color="red" dark @click="deleteAgent(row.item.id)">
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
     name: "AgentDetails",
     components:{
         Layout,
     },
     props:{
        agents:Array,
        agent: Object,
     },
     data(){
         return {
             search: '',
             headers: [
                 //{ text: 'Order Id', value: 'id' },
                 {
                     text: 'User Id',
                     align: 'start',
                     sortable: false,
                     value: 'id',
                 },

                 { text: 'Email', value: 'email' },
                 { text: 'Username', value: 'userName' },
                 { text: 'Name', value: 'name' },
                 { text: 'Telephone No.', value: 'telephone' },
                 { text: 'NIC', value: 'NIC' },
             ],

         }
     },
     methods:{
         edit:function (data){
             console.log("hello")
             this.$inertia.post('/agentDetails/edit', data)
         },
         deleteAgent:function (data){
             console.log("hello")
             this.$inertia.post('/agentDetails/delete/' + data)
         },

     }
 }
 </script>
