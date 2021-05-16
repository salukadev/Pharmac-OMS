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
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
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
                                                        Add Category
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="headline">{{ formTitle }}</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-form
                                                                ref="addCategory"
                                                                v-model="valid"
                                                                lazy-validation>

                                                                <v-row>
                                                                    <v-col
                                                                        cols="12">

                                                                        <v-text-field
                                                                            v-model="addCategory.catName"
                                                                            :counter="50"
                                                                            :rules="nameRules"
                                                                            label="Name"
                                                                            required>

                                                                            </v-text-field>
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
                                            :items="categories"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{row.item.id}}</td>
                                                    <td>{{row.item.catName}}</td>
                                                    <!--
                                                    <td>{{row.item.created_at}}</td>
                                                    <td>{{row.item.updated_at}}</td> -->

                                                    <td>
                                                        <v-btn color="green" dark @click="editItem(row.item)">
                                                            <v-icon dark>mdi-pencil</v-icon>
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
    name: "category",
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
            output: null,
            valid:true,
            form: false,
            editing:false,
            addCategory:{
                catName: '',

            },

             search: '',
             headers: [
                 {
                     text: 'ID',
                     align: 'start',
                     sortable: false,
                     value: 'id',
                 },

                    { text: 'Name', value: 'catName' },
                   // { text: 'Created', value: 'created_at' },
                   // { text: 'Edited', value: 'edited_at' },
             ],

            nameRules: [
                v => !!v || 'This field is required',
                v => (v && v.length <= 50) || 'Must be less than 50 characters',
            ],


         }
     },

    computed: {
        formTitle () {
            if(this.editing === true){
                return "Edit Category";
            }else{
                return "Add Category";

            }
        },
    },
    methods:{
        edit:function (data){
            this.$inertia.post('/category/update/', data)
        },
        editItem:function(item){
            this.editing=true;
            Object.assign(this.addCategory,item);
            this.form = true;
        },
        closeForm(){
            this.$refs.addCategory.reset();
            this.editing=false;
            this.form = false;
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
        validate () {
            this.$refs.addCategory.validate()
        },
        reset () {
            this.form = false
            this.$refs.addCategory.reset()
        },
        submit() {

            if(this.$refs.addCategory.validate()) {
                if (!this.editing) {
                    this.$inertia.post('/category/store/', this.addCategory)
                } else {
                    console.log("Updating....");
                    this.$inertia.post('/category/update/', this.addCategory);
                }
                this.closeForm();
            }
        },
    }
}
</script>
