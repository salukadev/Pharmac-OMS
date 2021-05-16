<template>
    <Layout title="Returns">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Return Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->


                                    <v-card>

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
                                            :items="product_returns"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr >
                                                    <td>{{row.item.order_id}}</td>
                                                    <td>{{row.item.reason}}</td>
                                                    <td>{{row.item.remark}}  </td>
                                                    <td>{{row.item.type}}</td>
                                                    <td>{{row.item.returnStatus}} </td>
                                                    <td><a href="#" @click="editform(row.item.order_id)"><v-icon small color="green lighten-1">edit</v-icon> </a></td>

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




            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centeredgit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLebel">Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


        </v-app>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

export default {
    name: "ReturnDetails",
    components:{
        Layout,
    },
    props:{
        product_returns:Array,
        product_return: Object,
    },
    data(){
        return {
            //this.dialogdetail = true
            search: '',
            headers: [

                {
                    text: 'Order ID',
                    align: 'start',
                    sortable: false,
                    value: 'order_id',
                },
                { text: 'Reason', value: 'reason' },
                { text: 'Remark', value: 'remark' },
                { text: 'Type', value: 'type' },
                { text: 'Status', value: 'returnStatus' },

            ],

        }
    },
    methods:{
        editSup(item){
            this.dialogdetail = true
            this.dialogEdit = item
            console.log(item)
            //this.$inertia.post('/supplier/update' + item)
        },


    }
}
</script>
