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
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Registered At</th>
                                                <th>Modify</th>
                                            </tr>


                                            <tr v-for="user in product_returns.data" :key="user.id">

                                                <td>{{user.id}}</td>
                                                <td>{{user.name}}</td>
                                                <td>{{user.email}}</td>
                                                <td>{{user.type | upText}}</td>
                                                <td>{{user.created_at | myDate}}</td>

                                                <td>
                                                    <a href="#" @click="editModal(user)">
                                                        <i class="fa fa-edit blue"></i>
                                                    </a>
                                                    /
                                                    <a href="#" @click="deleteUser(user.id)">
                                                        <i class="fa fa-trash red"></i>
                                                    </a>

                                                </td>
                                            </tr>
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
