<template>
    <Layout title="Product Requests">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Product Request Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->




                                    <v-card>
                                        <div style="text-align: right; padding: 20px">
<!--                                            <v-btn color="blue" dark href="/productRequest/add">-->
<!--                                                <v-icon dark>add</v-icon>-->
<!--                                                Add Product Request-->
<!--                                            </v-btn>-->

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
                                                            Add Product Request
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <v-card-title>
                                                            <span class="headline">Add Product Request</span>
                                                        </v-card-title>
                                                        <v-card-text>
                                                            <v-container>
                                                                <v-form
                                                                    ref="addProductRequest"
                                                                    v-model="valid"
                                                                    lazy-validation
                                                                >

                                                                    <v-row>
                                                                        <v-col
                                                                            cols="12"
                                                                        >
                                                                            <v-text-field
                                                                                v-model="addProductRequest.user_id"
                                                                                :counter="3"
                                                                                :rules="user_idRules"
                                                                                label="User ID"
                                                                                required
                                                                            ></v-text-field>
                                                                        </v-col>

                                                                        <v-col cols="12">
                                                                            <v-text-field
                                                                                v-model="addProductRequest.generic"
                                                                                :counter="100"
                                                                                :rules="genericRules"
                                                                                label="Generic"
                                                                                required
                                                                            ></v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="12">
                                                                            <v-text-field
                                                                                v-model="addProductRequest.brand"
                                                                                :counter="100"
                                                                                :rules="brandRules"
                                                                                label="Brand"
                                                                                type="text"
                                                                                required
                                                                            ></v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="12">
                                                                            <v-text-field
                                                                                v-model="addProductRequest.description"
                                                                                :counter="100"
                                                                                label="Description"
                                                                                type="text"
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
                                            :items="productRequests"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{row.item.reqestId}}</td>
                                                    <td>{{row.item.user_id}}</td>
                                                    <td>{{row.item.generic}}</td>
                                                    <td>{{row.item.brand}}</td>
                                                    <td>{{row.item.description}}</td>
                                                    <td>
                                                        <v-btn color="red" dark @click="deleteProductRequest(row.item.reqestId)">
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
    name: "ProductRequestsAll",
    components:{
        Layout,
    },
    props:{
        productRequests:Array,
    },
    data(){
        return {

            valid:true,
            form: false,
            addProductRequest:{
                user_id:'',
                generic:'',
                brand:'',
                description:'',
            },

            user_idRules: [
                v => !!v || 'User id is required',
            ],

            genericRules: [
                v => !!v || 'Generic is required',
                v => (v && v.length <= 100) || 'Generic must be less than 100 characters',
            ],
            brandRules: [
                v => !!v || 'Brand is required',
                v => (v && v.length <= 100) || 'Brand must be less than 100 characters',
            ],


            search: '',
            headers: [
                //{ text: 'Order Id', value: 'id' },
                {
                    text: 'Request Id',
                    align: 'start',
                    sortable: false,
                    value: 'reqestId',
                },

                { text: 'User id', value: 'user_id' },
                { text: 'Generic', value: 'generic' },
                { text: 'Brand', value: 'brand' },
                { text: 'Description', value: 'description' },
            ],

        }
    },
    methods:{
        deleteProductRequest:function (data){
            console.log("hello")
            this.$inertia.post('/productRequest/delete/' + data)
        },
        validate () {
            this.$refs.addProductRequest.validate()
        },
        reset () {
            this.form = false
            this.$refs.addProductRequest.reset()
        },
        submit() {
            if(this.$refs.addProductRequest.validate()) {
                this.$inertia.post('/productRequest/store', this.addProductRequest)
                this.$refs.addProductRequest.reset()
                this.form = false
            }
        },
        print () {
            console.log(this.agents);
            const columns = [
                { title: "Request ID", dataKey: "reqestId" },
                { title: "User ID", dataKey: "user_id" },
                { title: "Generic", dataKey: "generic" },
                { title: "Brand", dataKey: "brand" },
                { title: "Description", dataKey: "description" },

            ];
            const doc = new jsPDF('p', 'pt'
            );

            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All Product Requests Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.productRequests
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
            doc.save("Product Requests.pdf");
        },

    }
}
</script>

<style scoped>

</style>
