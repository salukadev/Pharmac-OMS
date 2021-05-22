
<template>
    <Layout title = "Complaints">
       <v-app>
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-12">
                     <div class="card">
                         <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                              <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Complaint Management</h4>
                         </div>

                    <div class="card-body">
                        <div class="toolbar">
                             <!-- Here you can write extra buttons/actions for the toolbar    -->
                        </div>

                        <div class="material-datatables">

                            <v-card>
                                <div style="text-align: right; padding: 20px">

                                    <!--goto create complaint method-->

                                    <v-btn color="blue" dark href='/create'>
                                        <v-icon dark>add</v-icon>
                                        Add Complaint
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
                                    :items="complaints"
                                    :search="search"
                                    class="table-striped table-no-bordered table-hover dataTable"
                                >
                                <template v-slot:item="co">
                                    <tr>
                                        <td>{{co.item.complaintId}}</td>
                                        <td>{{co.item.user_id}}</td>
                                        <td>{{co.item.category}}</td>
                                        <td>{{co.item.message}}</td>
                                        <td>{{co.item.status}}</td>


                                        <!--goto edit complaint method using a button-->
                                        <td>
                                            <v-btn color="green" dark @click='edit(co.item)'>
                                                        <v-icon dark>mdi-pencil</v-icon>
                                            </v-btn>
                                        </td>

                                        <!--goto delete complaint method using a button-->
                                        <td>
                                            <v-btn color="red" dark @click="deleteComplaint(co.item.complaintId)">
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


import Layout from '../../../Shared/Admin/Layout'

export default {
    name: "Complaint",
    components:{
        Layout,
    },
    props:['complaints'],     // pass the data to the vue componet

    data(){
         return {
             search: '',

                             // make the header of the table
             headers: [

                 {
                     text: 'Complaint ID',
                     align: 'start',
                     sortable: false,
                     value: 'complaintId',
                 },

                 { text: 'user ID', value: 'user_id' },
                 { text: 'Category', value: 'category' },
                 { text: 'Message', value: 'message' },
                 { text: 'Status', value: 'status' },

             ],

         }


    },

    methods:{

    //deifene the edit Complaint method
        edit:function(data){
            this.$inertia.post('/editComplaint', data)
        },

    //deifene the delete Complaint method
        deleteComplaint:function(data){
            this.$inertia.post('/deleteComplaint/'+ data)
        },
    }
}
</script>
