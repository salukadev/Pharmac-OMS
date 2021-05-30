<template>
    <Layout title="Customers">
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
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->



                                    <v-card>
                                        <div style="text-align: right; padding: 20px">
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
                                                        Add Customer
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="headline">Customer</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-form
                                                                ref="addCustomer"
                                                                v-model="valid"
                                                                lazy-validation
                                                            >

                                                                <v-row>
                                                                    <v-col
                                                                        cols="12"
                                                                    >
                                                                        <v-text-field
                                                                            v-model="addCustomer.email"
                                                                            :counter="25"
                                                                            :rules="emailRules"
                                                                            label="Email"
                                                                            required
                                                                            clearable
                                                                        ></v-text-field>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addCustomer.userName"
                                                                            :counter="15"
                                                                            :rules="userNameRules"
                                                                            label="Username"
                                                                            required
                                                                            clearable
                                                                        ></v-text-field>
                                                                    </v-col>


                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addCustomer.password"
                                                                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                                            :counter="15"
                                                                            :rules="passwordRules"
                                                                            label="Password"
                                                                            :type="show1 ? 'text' : 'password'"
                                                                            @click:append="show1 = !show1"
                                                                            required
                                                                            clearable>
                                                                        </v-text-field>
                                                                    </v-col>


                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addCustomer.name"
                                                                            :counter="25"
                                                                            :rules="nameRules"
                                                                            label="Name"
                                                                            type="text"
                                                                            required
                                                                            clearable
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addCustomer.telephone"
                                                                            :counter="10"
                                                                            :rules="telephoneRules"
                                                                            label="Telephone No."
                                                                            type="text"
                                                                            required
                                                                            clearable
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addCustomer.creditLimit"
                                                                            :counter="7"
                                                                            :rules="creditLimitRules"
                                                                            label="creditLimit"
                                                                            type="text"
                                                                            required
                                                                            clearable
                                                                            prefix="Rs."
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
                                                            Save
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
                                            :items="cus"
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
                                                    <td>{{row.item.creditLimit}}</td>
                                                    <td>
                                                        <v-btn color="green" dark @click="editCustomer(row.item)">
                                                            <v-icon dark>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>
                                                    <td>
                                                        <v-btn color="red" dark @click="deleteCustomer(row.item.id)">
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

import { jsPDF } from "jspdf";
import 'jspdf-autotable'

export default {
    name: "CustomerDetails",
    components:{
        Layout,
    },
    props:{
        cus:Array,
        customer: Object,
    },
    data(){


        return {
            show1: false,
            output: null,
            valid:true,
            form: false,
            editing:false,
            addCustomer:{
                email:'',
                userName:'',
                password:'',
                name:'',
                telephone:'',
                creditLimit:'',
            },


            //use validations for email
            emailRules: [
                v => !!v || 'Email id is required',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],

            //validation for user name
            userNameRules: [
                v => !!v || 'Generic is required',
                v => (v && v.length <= 15) || 'Generic must be less than 15 characters',
            ],

            //validation for password
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length <= 15) || 'Password must be less than 15 characters',
            ],

            //validation for name
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 25) || 'Name must be less than 25 characters',
            ],

            //validation for telephone number
            telephoneRules: [
                v => !!v || 'Telephone No. is required',
                v => (v && v.length <= 10) || 'Telephone No. must be less than 10 characters',
            ],

            //validation for credit limit
            creditLimitRules: [
                v => !!v || 'Credit Limit is required',
                v => (v && v.length <= 7) || 'Credit Limit must be less than 7 characters',
            ],


            search: '',
            headers: [

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
                { text: 'creditLimit', value: 'creditLimit' },
            ],

        }
    },
    computed: {
        formTitle () {

            if(this.editing === true){
                return "Edit Customer";
            }else{
                return "Add Customer";
            }
        },

    },
    methods:{

        edit:function (data){
            this.$inertia.post('/CustomerDetails/edit', data)
        },


        editCustomer:function(item){
            this.editing=true;
            Object.assign(this.addCustomer,item);
            this.form = true;
        },

        //form close function define
        closeForm(){
            this.$refs.addCustomer.reset();
            this.editing=false;
            this.form = false;
        },

        // promt message for delete record
        deleteCustomer:function (row) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: "Do you want to Delete this Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#13895a',
                cancelButtonColor: '#9a9292',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post('/CustomerDetails/delete/' + row)
                }
            })
        },

        //validate the inputs
        validate () {
            this.$refs.addCustomer.validate()
        },

        //reset record fields
        reset () {
            this.form = false
            this.$refs.addCustomer.reset()
        },

        //submit the details
        submit() {

            if(this.$refs.addCustomer.validate()) {
                if (!this.editing) {
                    this.$inertia.post('/CustomerDetails/store', this.addCustomer)
                } else {
                    this.$inertia.post('/CustomerDetails/update', this.addCustomer);
                }
                this.closeForm();
            }
        },

        //print the report
        print () {

            const columns = [
                { title: "ID", dataKey: "id" },
                { title: "Email", dataKey: "email" },
                { title: "userName", dataKey: "userName" },
                { title: "Name", dataKey: "name" },
                { title: "Telephone", dataKey: "telephone" },
                { title: "CreditLimit", dataKey: "creditLimit" },

            ];
            const doc = new jsPDF('p', 'pt'

            );

            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All customer Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.cus
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
            doc.save("AllCustomers.pdf");
        },

    }


}
</script>

<style scoped>

</style>
