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

                            </div>

                            <div class="material-datatables">
                                <!-- DATATABLE-->

                                <v-card>
                                    <div style="text-align: right; padding: 20px">
                                        <v-btn color="blue" dark href="/stock/add">
                                            <v-icon dark>add</v-icon>
                                            Add Product
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
                                                    <v-btn color="green" dark @click="edit(row.item)">
                                                        <v-icon dark>build</v-icon>
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
     name: "Stock",
     components:{
         Layout,
     },
     props:{
        stocks:Array,
        stock: Object,
        cat:Array,
        sup:Array
     },
     data(){
         return {
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
     methods:{
         edit:function (data){
             this.$inertia.post('/stock/edit', data)
         },
         deleteProduct:function (data){
             this.$inertia.post('/stock/delete/' + data)
         },

     }
 }
 </script>
