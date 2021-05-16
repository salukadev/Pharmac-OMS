
<template>
    <Layout title="User Account">
        <v-app>
            <div class="container--fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">User Details</h4>

                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>

                                <div class="material-datatables">

                                    <v-card>
                                        <div style="text-align: right; padding: 20px">
                                            <v-btn color="blue" dark href="/SubRole">
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
                                            :items="users"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable">

                                            <template v-slot:item="i">
                                                <tr>
                                                    <td>{{i.item.id}}</td>
                                                    <td>{{i.item.userType}}</td>
                                                    <td>{{i.item.email}}</td>
                                                    <td>{{i.item.userName}}</td>

                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                    <br><br>

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
import Layout from "../../Shared/Admin/Layout";

export default {
    name: "SubRoleView",
    components:{
        Layout,
    },
    props:['users'],

    data(){
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

                { text: 'User id', value: 'userType' },
                { text: 'Email', value: 'email' },
                { text: 'Username.', value: 'username' },
            ],

        }
    },

    methods: {
        deleteSub:function (StaffObject){
            this.$inertia.post('/SubRole/delete/'+ StaffObject.id)
        },
        updateSub:function (StaffObject){
            this.$inertia.post('/SubRole/edit/',StaffObject)
        },


    }
}
</script>

<style scoped>

</style>
