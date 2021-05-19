<template>
    <Layout title="Stock">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Stock Management</h4>

                            </div>
                            <div class="card-body">

                                <div class="toolbar">

                                    <!-- Successs messages -->
                                      <v-alert
                                        dense
                                        text
                                        type="success"
                                        v-if="successMessage">
                                        {{successMessage}}

                                    </v-alert>

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
                                                        transition="scale-transition"
                                                    >
                                                        <v-icon dark>add</v-icon>
                                                        Add Product
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="headline">{{ formTitle }}</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-form
                                                                ref="addProduct"
                                                                v-model="valid"
                                                                lazy-validation>

                                                                <v-row>
                                                                    <v-col
                                                                        cols="12"
                                                                    >
                                                                        <v-text-field
                                                                            v-model="addProduct.name"
                                                                            :counter="50"
                                                                            :rules="nameRules"
                                                                            label="Name"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-select
                                                                            v-model="addProduct.category_id"
                                                                            :items="cat"
                                                                            item-text="catName"
                                                                            item-value="id"
                                                                            label="Category"
                                                                            required
                                                                        ></v-select>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addProduct.brand"
                                                                            :counter="50"
                                                                            :rules="nameRules"
                                                                            label="Brand"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addProduct.quantity"
                                                                            :counter="10"
                                                                            :rules="numberRules"
                                                                            label="Quantity"
                                                                            type="number"
                                                                            min="0"
                                                                            step="1"
                                                                            required
                                                                        ></v-text-field>
                                                                    </v-col>
                                                                    <v-col cols="12">

                                                                        <v-text-field
                                                                            v-model="addProduct.unitPrice"
                                                                            :counter="10"
                                                                            :rules="numberRules"
                                                                            label="Unit Price"
                                                                            type="number"
                                                                            min="0"
                                                                            step = "1"
                                                                            required
                                                                        ></v-text-field>

                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <div>

                                                                        <v-menu
                                                                        ref="menu1"
                                                                        v-model="menu1"
                                                                        :close-on-content-click="true"
                                                                        transition="scale-transition"
                                                                        offset-y
                                                                        min-width="auto"
                                                                        required
                                                                        >
                                                                        <template v-slot:activator="{ on, attrs }">
                                                                            <v-text-field
                                                                            v-model="addProduct.mnfDate"
                                                                            label="Manufactured Date"
                                                                            prepend-icon="mdi-calendar"
                                                                            readonly
                                                                            v-bind="attrs"
                                                                            v-on="on"
                                                                            required
                                                                            ></v-text-field>
                                                                        </template>
                                                                        <v-date-picker
                                                                            v-model="addProduct.mnfDate"
                                                                            :active-picker.sync="activePicker"
                                                                            :max="new Date().toISOString().substr(0, 10)"
                                                                            min="1950-01-01"
                                                                            required
                                                                            @change="save"
                                                                        ></v-date-picker>
                                                                        </v-menu>
                                                                    </div>


                                                                    </v-col>
                                                                    <v-col cols="12">
                                                                  <div>
                                                                        <v-menu
                                                                        ref="menu"
                                                                        v-model="menu"
                                                                        :close-on-content-click="true"
                                                                        transition="scale-transition"
                                                                        offset-y
                                                                        min-width="auto"
                                                                        >

                                                                        <template v-slot:activator="{ on, attrs }">
                                                                            <v-text-field
                                                                            v-model="addProduct.expDate"
                                                                            label="Expiery Date"
                                                                            prepend-icon="mdi-calendar"
                                                                            readonly
                                                                            v-bind="attrs"
                                                                            v-on="on"
                                                                            required
                                                                            ></v-text-field>
                                                                        </template>

                                                                        <v-date-picker
                                                                            v-model="addProduct.expDate"
                                                                            :active-picker.sync="activePicker"
                                                                            :min = addProduct.mnfDate
                                                                            @change="save"
                                                                            required
                                                                        ></v-date-picker>
                                                                        </v-menu>
                                                                    </div>

                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-select
                                                                            v-model="addProduct.supplier_id"
                                                                            :items="sup"
                                                                            item-text="supName"
                                                                            item-value="id"
                                                                            label="Supplier"
                                                                            required
                                                                        ></v-select>
                                                                    </v-col>

                                                                    <v-col cols="12">
                                                                        <v-text-field
                                                                            v-model="addProduct.batchNo"
                                                                            :counter="50"
                                                                            :rules="nameRules"
                                                                            label="Batch No."
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

                                        <!-- Table-->
                                        <v-data-table
                                            :headers="headers"
                                            :items="stocks"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{row.item.id}}</td>
                                                    <td>{{row.item.name}}</td>
                                                    <td>{{row.item.category.catName}}</td>
                                                    <td>{{row.item.brand}}</td>
                                                    <td>{{row.item.quantity}}</td>
                                                    <td>{{row.item.unitPrice}}</td>
                                                    <td>{{row.item.mnfDate}}</td>
                                                    <td>{{row.item.expDate}}</td>
                                                    <td>{{row.item.supplier.supName}}</td>
                                                    <td>{{row.item.batchNo}}</td>
                                                    <td>

                                                        <v-btn color="green" dark @click="editItem(row.item)">
                                                            <v-icon dark>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </td>

                                                    <td>
                                                        <v-btn color="red" dark @click="deleteProduct(row.item.id)">
                                                            <v-icon dark>delete</v-icon>
                                                        </v-btn>
                                                    </td>
                                                </tr>
                                            </template>
                                        </v-data-table>

                                        <!-- End of table-->

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
    name: "Stock",
    components:{
        Layout,
    },

    //Props comming from controller

    props:{
        stocks:Array,
        stock: Object,
        cat:Array,
        sup:Array,
        report:Array,
        successMessage:Array},
    data(){
        return {

            output: null,
            valid:true,
            form: false,
            editing:false,
            addProduct:{
                name: '',
                category_id: '',
                brand: '',
                quantity: '',
                unitPrice: '',
                mnfDate: '',
                expDate: '',
                supplier_id: '',
                batchNo: ''

            },

            nameRules: [
                v => !!v || 'This field is required',
                v => (v && v.length <= 50) || 'Must be less than 50 characters',
            ],

            numberRules: [
                v => !!v || 'This field is required',
                v => (v && parseFloat(v) > 0) || 'Value can not be negative',
                v => (v && parseFloat(v) < 9999999999) || 'Value must be less than 10 characters',
            ],

            dateRules: [
                v => (moment(v).format("dd-mm-yyyy") < moment(addProduct.mnfDate).format("dd-mm-yyyy")) || 'EXP date should nor be le than MNF date',
            ],


            //Stock table structure
            search: '',
            headers: [
                {
                    text: 'ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                    { text: 'Name', value: 'name' },
                    { text: 'Category', value: 'category_id' },
                    { text: 'Brand', value: 'brand' },
                    { text: 'Quantity', value: 'quantity' },
                    { text: 'Unit Price', value: 'unitPrice' },
                    { text: 'MFD', value: 'mnfDate' },
                    { text: 'EXP', value: 'expDate' },
                    { text: 'Supplier', value: 'supplier_id' },
                    { text: 'Batch No.', value: 'batchNo' }
            ],

        }
    },

    //Checks for edit or update
    computed: {
        formTitle () {
            if(this.editing === true){
                return "Edit Product";
            }else{
                return "Add Product";

            }
        },
    },

    //Functions
    methods:{
        edit:function (data){
            this.$inertia.post('/stock/update/', data)
        },
        editItem:function(item){
            this.editing=true;
            Object.assign(this.addProduct,item);
            this.form = true;
        },
        closeForm(){
            this.$refs.addProduct.reset();
            this.editing=false;
            this.form = false;
        },
        deleteProduct:function (data){

            this.$swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
               this.$inertia.post('/stock/delete/' + data)
            }
            })

        },
        validate () {
            this.$refs.addProduct.validate()
        },
        reset () {
            this.form = false
            this.$refs.addProduct.reset()
        },
        submit() {

            if(this.$refs.addProduct.validate()) {
                if (!this.editing) {
                    this.$inertia.post('/stock/store', this.addProduct)
                } else {
                    console.log("Updating....");
                    this.$inertia.post('/stock/update', this.addProduct);
                }
                this.closeForm();
            }
        },

        //Table structure
        print () {
            console.log(this.sup);
            const columns = [
                    { title: 'Name', dataKey: 'name' },
                    { title: 'Category', dataKey: 'catName' },
                    { title: 'Brand', dataKey: 'brand' },
                    { title: 'Quantity', dataKey: 'quantity' },
                    { title: 'Unit Price', dataKey: 'unitPrice' },
                    { title: 'MFD', dataKey: 'mnfDate' },
                    { title: 'EXP', dataKey: 'expDate' },
                    { title: 'Supplier', dataKey: 'supName' },
                    { title: 'Batch No.', dataKey: 'batchNo' }
            ];
            const doc = new jsPDF('p', 'pt');

            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All Stock Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.report
                //Load data from report prop
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
            doc.save("AllStock.pdf");
        },

    }
}
</script>
