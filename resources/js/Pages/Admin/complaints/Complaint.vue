
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

                        </div>

                        <div class="material-datatables">

                            <!--making poo up window -->
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
                                                Add Complaint
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formTitle }}</span>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-container>
                                                    <v-form
                                                        ref="com"
                                                        v-model="valid"
                                                        lazy-validation
                                                    >

                                                        <v-row>

                                                            <!-- user id text field-->
                                                            <v-col cols="12">
                                                                <v-text-field
                                                                    v-model="com.user_id"
                                                                    :counter="10"
                                                                    :rules="UserIdlRules"
                                                                    label="UserID"
                                                                    required
                                                                ></v-text-field>
                                                            </v-col>

                                                            <!-- category select field-->
                                                            <v-col cols="12">
                                                                <v-select
                                                                    v-model="com.category"
                                                                    :items="items"
                                                                    :counter="15"
                                                                    :rules="categoryRules"
                                                                    label="Category"
                                                                    required
                                                                ></v-select>
                                                            </v-col>

                                                            <!-- message text field-->
                                                            <v-col cols="12">
                                                                <v-textarea
                                                                    v-model="com.message"
                                                                    :counter="250"
                                                                    :rules="MessageRules"
                                                                    label="Message"

                                                                    required
                                                                ></v-textarea>
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
                                        <td>{{co.item.created_at}}</td>

                                        <!--goto edit complaint method using a button-->
                                        <td>
                                            <v-btn color="green" dark @click='edit(co.item)'>
                                                        View
                                            </v-btn>


                                        </td>

                                        <!--goto delete complaint method using a button-->
                                        <td>
                                            <v-btn color="red" dark @click="deleteProduct(co.item.complaintId)">
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

                </div>
            </div>
           </div>
           </div>
       </v-app>


    </Layout>

</template>

<script>


import Layout from '../../../Shared/Admin/Layout'
import {jsPDF} from "jspdf";
import 'jspdf-autotable'

export default {
    name: "Complaint",
    components:{
        Layout,
    },
    props:['complaints'],

    data(){
         return {

             output: null,
             valid:true,
             form: false,
             editing:false,
             com:{
                 UserID:'',
                 Category:'',
                 Message:'',

             },

             //items in the category list
             items: [
                 'Products',
                 'Agent',
                 'Delivery Services',
                 'Other',

             ],

             complaint: {
                 complaintId: 'complaint.complaintId',
                user_id: 'complaint.user_id',
                category: 'complaint.category',
                message: 'complaint.message',
                status: 'complaint.status',
        },



             //validate user ID
             UserIdlRules: [
                 v => !!v || 'UserId is required',
             ],

             //validate category
             categoryRules: [
                 v => !!v || 'category is required',

             ],

             //validate message
             MessageRules: [
                 v => !!v || 'Message is required',
                 v => (v && v.length <= 250) || 'Password must be less than 15 characters',
             ],

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
                 { text: 'Created_at', value: 'created_at' },
             ],

         }


    },

    methods: {

        //deifene the edit Complaint method
        edit: function (data) {
            this.$inertia.post('/editComplaint', data)
        },

        //define the delete Complaint method

        deleteProduct:function (data) {
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
                    this.$inertia.post('/deleteComplaint/' + data)
                }
            })
        },

        //define the close form method
        closeForm() {
            this.$refs.com.reset();
            this.editing = false;
            this.com = false;
        },


        //define the validate method
        validate() {
            this.$refs.com.validate()
        },

        //define reset method
        reset() {
            this.form = false
            this.$refs.com.reset()
        },

        //define submit method
        submit() {
            this.form = false
            this.$inertia.post('/addComplaint', this.com)
            this.closeForm();
        },

        //define update method
        update:function(complaint){
            this.$inertia.post('/updateComplaint',complaint);
        },

        //define print report method
        print () {

            const columns = [
                { title: "ComplaintID", dataKey: "complaintId" },
                { title: "User ID", dataKey: "user_id" },
                { title: "Category", dataKey: "category" },
                { title: "Message", dataKey: "message" },
                { title: "Status", dataKey: "status" }


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

            doc.setFontSize(13).text("Report: All Complaint Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.complaints
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
            doc.save("All_Complaints.pdf");
        },
    }
}
</script>
