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
                                <h4 class="card-title">SubRole Management</h4>

                            </div>
                            <div class="card-body">
                                <div class="toolbar">


                                </div>

                                <div class="material-datatables">


                                    <v-card>
                                        <div style="text-align: right; padding: 20px">
                                        <v-btn color="blue" dark href="/AddCommission">
                                            <v-icon dark>add</v-icon>
                                            Add Staff Member

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
                                                        <v-btn color="red" dark @click="deleteSub(CommissionObject.item)">
                                                            <v-icon dark>delete</v-icon>
                                                        </v-btn>
                                                    </td>
                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                    <br><br>
                                    <div style="text-align: right; padding-right: 20px">
                                        <v-btn color="blue" dark href="">
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

export default {
    name: "Commission",
    components: {Layout},

    props: ['Commissions'],

    data() {
        return {
            search: '',
            headers: [
                //{ text: 'Order Id', value: 'id' },
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
        deleteSub:function (CommissionObject) {
            this.$inertia.post('/Commission/delete/'+ CommissionObject.id)
        },

    }
}


</script>

<style scoped>

</style>
