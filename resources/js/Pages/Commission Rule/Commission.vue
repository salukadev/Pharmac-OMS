<template>
    <Layout title="Commission Rule Management">
        <v-app>
            <div class="container--fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Commission Management</h4>

                            </div>
                            <div class="card-body">
                                <div class="toolbar">


                                </div>

                                <div class="material-datatables">


                                    <v-card>
                                        <div style="text-align: right; padding: 30px">

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
                                                        Add Commission Rule
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="headline">{{ formTitle }}</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-form
                                                                ref="Commission"
                                                                v-model="valid"
                                                                lazy-validation
                                                            >

                                                                <v-row>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="Commission.adminid"
                                                                            :counter="5"
                                                                            :rules="adminid"
                                                                            label="Admin ID"
                                                                            type="text"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="Commission.minref"
                                                                            :counter="10"
                                                                            :rules="minref"
                                                                            label="Commission Min Ref"
                                                                            type="numbers"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="Commission.pointerref"
                                                                            :counter="10"
                                                                            :rules="pointper"
                                                                            label="Point Per Ref"
                                                                            type="numbers"
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
                                            :items="Commissions"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable">

                                            <template v-slot:item="CommissionObject">
                                                <tr>

                                                    <td>{{CommissionObject.item.id}}</td>
                                                    <td>{{CommissionObject.item.admin_id}}</td>
                                                    <td>{{CommissionObject.item.minRefs}}</td>
                                                    <td>{{CommissionObject.item.pointPerRef}}</td>

                                                    <td>
                                                        <v-btn color="red" dark @click="deleteProduct(CommissionObject.item)">
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
import Layout from '../../Shared/Admin/Layout'
import {jsPDF} from "jspdf";
import 'jspdf-autotable'

export default {
    name: "Commission",
    components: {Layout},

    props: ['Commissions'], //getting data from another vue


    data() {
        return {
            output: null,
            valid: true,
            form: false,
            editing: false,

            //form variavles
            Commission: {
                adminid: '',
                minref: '',
                pointerref: '',

            },

            //validation

            adminid: [
                v => !!v || 'Admin ID is required',
            ],
            minref: [
                v => !!v || 'Min Ref  is required',
                v => (v && v.length <= 10) || 'Min Ref must be less than 10 characters',
            ],
            pointper: [
                v => !!v || 'Point Per Ref is required',
                v => (v && v.length <= 10) || 'Point Per Ref must be less than 10 characters',
            ],


            search: '',

            //table data
            headers: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                {text: 'Admin ID', value: 'admin_id'},
                {text: 'Min Ref', value: 'minRefs'},
                {text: 'Point Per Ref.', value: 'pointPerRef'},

            ],

        }
    },
    methods: {

        //delete commossion details

        deleteProduct: function (CommissionObject) {
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
                    this.$inertia.post('/Commission/delete/' + CommissionObject.id)
                }
            })
        },

        //Close popup form

        closeForm() {
            this.$refs.Commission.reset();
            this.editing = false;
            this.form = false;
        },

        //Reset pop up form

        reset() {
            this.form = false
            this.$refs.Commission.reset()
        },

        //data saving to the database
        submit() {

            if (this.$refs.Commission.validate()) {
                this.$inertia.post('/getCommission', this.Commission)

            }
            this.closeForm();


        },

        // print Pdf file

        print() {

            // table header and columns
            const columns = [
                {title: "ID", dataKey: "id"},
                {title: "Admin Id", dataKey: "admin_id"},
                {title: "Minimum Refs", dataKey: "minRefs"},
                {title: "Point Per Ref", dataKey: "pointPerRef"},

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
                margin: {top: 130},
                columns,
                body: this.Commissions
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
            doc.save("Commission Rule.pdf");
        }

    }
}


</script>

<style scoped>

</style>
