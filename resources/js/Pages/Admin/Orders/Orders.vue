<template>
    <Layout title="Orders">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Order Management</h4>
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
                                :items="orders"
                                :search="search"
                                class="table-striped table-no-bordered table-hover dataTable"
                            >
                                <template v-slot:item.glutenfree="{ item }">
                                    <v-simple-checkbox v-model="item.glutenfree" disabled></v-simple-checkbox>
                                </template>
                            </v-data-table>
                            </v-card>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
    </div>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

export default {
    name: "Orders",
    mounted:function(){
        //this.$swal('Hello World !!!');
    },
    components:{
        Layout,
    },
    props:{
        orders:Array,
    },
    data(){
        return {
            search: '',
            headers: [
                { text: 'Id', value: 'id' },
                {
                    text: 'Customer',
                    align: 'start',
                    sortable: false,
                    value: 'customer.name',
                },

                { text: 'Order Type', value: 'type' },
                { text: 'Amount', value: 'amount' },
                { text: 'Status', value: 'status' },
                { text: 'Placed on', value: 'created_at' },
            ],

        }
    }
}
</script>

<style scoped>

</style>
