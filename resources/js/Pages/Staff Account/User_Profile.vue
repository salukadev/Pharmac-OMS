
<template>
    <Layout title="User Account">
        <v-app>
            <div class="container--fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">User Details</h4>

                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>

                                <div class="material-datatables">

                                    <v-card>
                                        <div style="text-align: right; padding: 30px">
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
                                                        Add Staff Member
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="headline">{{ formTitle }}</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-form
                                                                ref="addSubRole"
                                                                v-model="valid"
                                                                lazy-validation
                                                            >

                                                                <v-row>
                                                                    <v-col
                                                                        cols="12"
                                                                    >
                                                                        <v-text-field
                                                                            v-model="addSubRole.user_id"
                                                                            :counter="8"
                                                                            :rules="UserID"
                                                                            label="User ID"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addSubRole.name"
                                                                            :counter="25"
                                                                            :rules="Staff_name"
                                                                            label="Staff Account name"
                                                                            type="text"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addSubRole.telephone"
                                                                            :counter="10"
                                                                            :rules="Telephone_No"
                                                                            label="Telephone"
                                                                            type="numbers"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-select
                                                                            v-model="addSubRole.department"
                                                                            :counter="25"
                                                                            :rules="Department"
                                                                            :items="depart"
                                                                            label="Department"
                                                                            type="text"
                                                                            required
                                                                        ></v-select>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addSubRole.accessLevel"
                                                                            :counter="12"
                                                                            :rules="AccessLavel"
                                                                            label="Access Level."
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
                                            :items="users"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable">

                                            <template v-slot:item="i">
                                                <tr>
                                                    <td>{{i.item.id}}</td>
                                                    <td>{{i.item.userType}}</td>
                                                    <td>{{i.item.email}}</td>
                                                    <td>{{i.item.userName}}</td>

                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

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
                </div>

        </v-app>

    </Layout>
</template>

<script>
import Layout from "../../Shared/Admin/Layout";

import { jsPDF } from "jspdf";
import 'jspdf-autotable'

export default {
    name: "SubRoleView",
    components:{
        Layout,
    },
    props:{
        users:Object,
    },

    data: function () {
        return {

            output: null,
            valid: true,
            form: false,
            editing: false,
            addSubRole: {
                user_id: '',
                name: '',
                telephone: '',
                department: '',
                accessLevel: '',
            },


            UserID: [
                v => !!v || 'User ID id is required',
            ],

            Staff_name: [
                v => !!v || 'Staff Account name is required',
                v => (v && v.length <= 25) || 'name must be less than 15 characters',
            ],
            Telephone_No: [
                v => !!v || 'Phone number  is required',
                v => (v && v.length <= 10) || 'Phone number must be less than 15 characters',
            ],
            Department: [
                v => !!v || 'Department is required',
                v => (v && v.length <= 25) || 'Department must be less than 25 characters',
            ],
            AccessLavel: [
                v => !!v || 'Access level is required',
                v => (v && v.length === 1) || 'Access level must be less than one characters',
            ],

            depart:[
                'IT',
                'Management',
                'Engineering',
                'Others',
            ],

            search: '',
            headers: [
                //{ text: 'Order Id', value: 'id' },
                {
                    text: 'Id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                {text: 'User Type', value: 'userType'},
                {text: 'Email', value: 'email'},
                {text: 'Username.', value: 'userName'},
            ],

        }
    },

    methods: {

        closeForm(){
            this.$refs.addSubRole.reset();
            this.editing=false;
            this.form = false;
        },

        reset () {
            this.form = false
            this.$refs.addSubRole.reset()
        },
        submit() {

            // this.$refs.addAgent.reset()
            // this.form = false
            if(this.$refs.addSubRole.validate()) {
                if (!this.editing) {
                    this.$inertia.post('/getaddSubRole', this.addSubRole)
                    //this.$inertia.post('/agentDetails/store', this.addAgent)
                } else {
                    this.$inertia.post('/SubRole/update/', this.addSubRole);
                }
                this.closeForm();
            }
        },


        deleteSub:function (StaffObject){
            this.$inertia.post('/SubRole/delete/'+ StaffObject.id)
        },
        updateSub:function (StaffObject){
            this.$inertia.post('/SubRole/edit/',StaffObject)
        },

        print () {
            const columns = [
                { title: "User ID", dataKey: "id" },
                { title: "User Type", dataKey: "userType" },
                { title: "Email", dataKey: "email" },
                { title: "User Name", dataKey: "userName" },


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

            doc.setFontSize(13).text("Report: All Staff Acount Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.users
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
            doc.save("User Details.pdf");
        },


    }
}
</script>

<style scoped>

</style>
