<template>
    <Layout title="Staff Accounts">
     <v-app>
         <div class="container--fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-header card-header-primary card-header-icon">
                             <div class="card-icon">
                                 <i class="material-icons">assignment</i>
                             </div>
                             <h4 class="card-title">Manage Staff Accounts </h4>

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
                                                                     <v-text-field
                                                                         v-model="addSubRole.department"
                                                                         :counter="25"
                                                                         :rules="Department"
                                                                         label="Department"
                                                                         type="text"
                                                                         required
                                                                     ></v-text-field>
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
                                         :items="Staff"
                                         :search="search"
                                         class="table-striped table-no-bordered table-hover dataTable">

                                         <template v-slot:item="StaffObject">
                                             <tr>
                                                 <td>{{StaffObject.item.id}}</td>
                                                 <td>{{StaffObject.item.user_id}}</td>
                                                 <td>{{StaffObject.item.name}}</td>
                                                 <td>{{StaffObject.item.telephone}}</td>
                                                 <td>{{StaffObject.item.department}}</td>
                                                 <td>{{StaffObject.item.accessLevel}}</td>
                                                 <td>
                                                     <v-btn color="green" dark @click="editItem(StaffObject.item)">
                                                         <v-icon dark>build</v-icon>
                                                     </v-btn>
                                                 </td>
                                                 <td>
                                                     <v-btn color="red" dark @click="deleteProduct(StaffObject.item)">
                                                         <v-icon dark>delete</v-icon>
                                                     </v-btn>
                                                 </td>
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
import Layout from "../../Shared/Admin/Layout"
import { jsPDF } from "jspdf";
import 'jspdf-autotable'

export default {
    name: "SubRoleView",
    components:{
        Layout,
    },
    props:{
        Staff:Object
    },



    data(){

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

                //validate form

                StaffAccountid: [
                    v => !!v || 'User ID id is required',
                ],

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


                search: '',
                headers: [
                    //{ text: 'Order Id', value: 'id' },
                    {
                        text: 'Id',
                        align: 'start',
                        sortable: false,
                        value: 'id',
                    },

                    {text: 'User id', value: 'user_id'},
                    {text: 'Name', value: 'name'},
                    {text: 'Telephone No.', value: 'telephone'},
                    {text: 'Department.', value: 'department'},
                    {text: 'Access Level', value: 'accessLevel'},
                ],

            }



    },



    methods: {

        closeForm(){
            this.$refs.addSubRole.reset();
            this.editing=false;
            this.form = false;
        },

        editItem:function(item){
            this.editing=true;
            Object.assign(this.addSubRole,item);
            this.form = true;
        },

        reset () {
            this.form = false
            this.$refs.addSubRole.reset()
        },

        submit() {

            // this.$refs.addAgent.reset()
            // this.form = false
            if(this.$refs.addSubRole.validate()) {

                    this.$inertia.post('/SubRole/update/', this.addSubRole);
                this.closeForm();
            }
        },

        deleteProduct:function (StaffObject) {
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
                    this.$inertia.post('/SubRole/delete/'+ StaffObject.id)
                }
            })
        },

        updateSub:function (StaffObject){
            this.$inertia.post('/SubRole/edit/',StaffObject)
        },
        print () {
            const columns = [
                { title: "Staff Member ID", dataKey: "id" },
                { title: "User ID", dataKey: "user_id" },
                { title: "Staff member name", dataKey: "name" },
                { title: "Telephone no", dataKey: "telephone" },
                { title: "Department", dataKey: "department" },
                { title: "Access Level", dataKey: "accessLevel" },

            ];
            const doc = new jsPDF('p', 'pt' //crate object from import class
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
                body: this.Staff
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
            doc.save("Staff Members.pdf");
        },



    }
}
</script>

<style scoped>

</style>
