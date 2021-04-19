<template>
    <Layout title="Category">
        <v-app>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Category Management</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">

                            </div>

                            <div class="material-datatables">
                                <!-- DATATABLE-->

                                <v-card>
                                    <div style="text-align: right; padding: 20px">
                                        <v-btn color="blue" dark href="/category/add">
                                            <v-icon dark>add</v-icon>
                                            Add Category
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
                                        :items="categories"
                                        :search="search"
                                        class="table-striped table-no-bordered table-hover dataTable"
                                    >
                                        <template v-slot:item="row">
                                            <tr>
                                                <td>{{row.item.id}}</td>
                                                <td>{{row.item.catName}}</td>
                                                <td>
                                                    <v-btn color="green" dark @click="edit(row.item)">
                                                        <v-icon dark>build</v-icon>
                                                    </v-btn>
                                                </td>
                                                <td>
                                                    <v-btn color="red" dark @click="deleteCategory(row.item.id)">
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
     name: "Category",
     components:{
         Layout,
     },
     props:{
        categories: Array,
        Category: Object,
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

                    { text: 'Name', value: 'catName' },
             ],

         }
     },
     methods:{
         edit:function (data){
             this.$inertia.post('/category/edit', data)
         },
         deleteCategory:function (data){

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
                this.$inertia.post('/category/delete/' + data)
            }
            })

         },
     }
 }
 </script>
