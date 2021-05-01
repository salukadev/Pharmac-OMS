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
<!--                                        <v-btn color="blue" dark href="/agentDetails/add">-->
<!--                                            <v-icon dark>add</v-icon>-->
<!--                                            Add Agent-->
<!--                                        </v-btn>-->
                                        <v-dialog
                                            v-model="form"
                                            persistent
                                            max-width="600px"
                                        >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                                >
                                                    <v-icon dark>add</v-icon>
                                                    Add Agent
                                                </v-btn>
                                            </template>
                                            <v-card>
                                                <v-card-title>
                                                    <span class="headline">Add Agent</span>
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-container>
                                                        <v-form
                                                            ref="addAgent"
                                                            v-model="valid"
                                                            lazy-validation
                                                        >

                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-text-field
                                                                        v-model="addAgent.email"
                                                                        :counter="25"
                                                                        :rules="emailRules"
                                                                        label="Email"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>

                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.userName"
                                                                        :counter="15"
                                                                        :rules="userNameRules"
                                                                        label="Username"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.password"
                                                                        :counter="15"
                                                                        :rules="passwordRules"
                                                                        label="Password"
                                                                        type="password"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.name"
                                                                        :counter="25"
                                                                        :rules="nameRules"
                                                                        label="Name"
                                                                        type="text"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.telephone"
                                                                        :counter="12"
                                                                        :rules="telephoneRules"
                                                                        label="Telephone No."
                                                                        type="text"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.NIC"
                                                                        :counter="12"
                                                                        :rules="NICRules"
                                                                        label="NIC"
                                                                        type="text"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field
                                                                        v-model="addAgent.BlacklistStatus"
                                                                        :counter="1"
                                                                        :rules="BlacklistStatusRules"
                                                                        label="BlackList Status"
                                                                        type="text"
                                                                        required
                                                                    ></v-text-field>
                                                                </v-col>

                                                            </v-row>
                                                        </v-form>
                                                    </v-container>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        color="error"
                                                        class="mr-4"
                                                        @click="reset"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        color="success"
                                                        class="mr-4"
                                                        @click="submit"
                                                    >
                                                        Add
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
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
                                                <td>{{co.item.id}}</td>
                                                <td>{{co.item.email}}</td>
                                                <td>{{co.item.userName}}</td>
                                                <td>{{co.item.name}}</td>
                                                <td>{{co.item.telephone}}</td>
                                                <td>{{co.item.NIC}}</td>
                                                <td>
                                                    <v-btn color="green" dark @click="edit(row.item)">
                                                        <v-icon dark>mdi-pencil</v-icon>
                                                    </v-btn>
                                                </td>
                                                <td>
                                                    <v-btn color="red" dark @click="deleteAgent(co.item.id)">
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
     name: "Complaint",
     components:{
         Layout,
     },
     props:{
        complaints:Array,
        co: Object,
     },
     data(){
         return {

             valid:true,
             form: false,
             addAgent:{
                 email:'',
                 userName:'',
                 password:'',
                 name:'',
                 telephone:'',
                 NIC:'',
                 BlacklistStatus:'',
             },

             emailRules: [
                 v => !!v || 'Email id is required',
             ],

             userNameRules: [
                 v => !!v || 'Generic is required',
                 v => (v && v.length <= 15) || 'Generic must be less than 15 characters',
             ],
             passwordRules: [
                 v => !!v || 'Password is required',
                 v => (v && v.length <= 15) || 'Password must be less than 15 characters',
             ],
             nameRules: [
                 v => !!v || 'Name is required',
                 v => (v && v.length <= 25) || 'Name must be less than 25 characters',
             ],
             telephoneRules: [
                 v => !!v || 'Telephone No. is required',
                 v => (v && v.length <= 12) || 'Telephone No. must be less than 12 characters',
             ],
             NICRules: [
                 v => !!v || 'NIC is required',
                 v => (v && v.length <= 12) || 'NIC must be less than 12 characters',
             ],
             BlacklistStatusRules: [
                 v => !!v || 'Blacklist status is required',
                 v => (v && v.length <= 1) || 'Blacklist status must be a single characters',
             ],

             search: '',
             headers: [
                 //{ text: 'Order Id', value: 'id' },
                 {
                     text: 'Complaint ID',
                     align: 'start',
                     sortable: false,
                     value: 'complaintId',
                 },

                 { text: '', value: 'email' },
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
         validate () {
             this.$refs.addAgent.validate()
         },
         reset () {
             this.form = false
             this.$refs.addAgent.reset()
         },
         submit() {
             this.$inertia.post('/agentDetails/store', this.addAgent)
             this.$refs.addAgent.reset()
             this.form = false
         },

     }
 }
 </script>
