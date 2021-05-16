<template>
    <Layout title="Staff Account">
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
                                         :items="Staff"
                                         :search="search"
                                         class="table-striped table-no-bordered table-hover dataTable">

                                         <template v-slot:item="StaffObject">
                                             <tr>
                                                 <td>{{StaffObject.item.id}}</td>
                                                 <td>{{StaffObject.item.user_id}}</td>
                                                 <td>{{StaffObject.item.name}}</td>
                                                 <td>{{StaffObject.item.telephone}}</td>
                                                 <td>{{StaffObject.item.department}}</td>
                                                 <td>{{StaffObject.item.accessLevel}}</td>
                                                 <td>
                                                     <v-btn color="green" dark @click="updateSub(StaffObject.item)">
                                                         <v-icon dark>build</v-icon>
                                                     </v-btn>
                                                 </td>
                                                 <td>
                                                     <v-btn color="red" dark @click="deleteSub(StaffObject.item)">
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
import Layout from "../../Shared/Admin/Layout";

export default {
    name: "SubRoleView",
    components:{
        Layout,
    },
    props:['Staff'],

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

                { text: 'User id', value: 'user_id' },
                { text: 'Name', value: 'name' },
                { text: 'Telephone No.', value: 'telephone' },
                { text: 'Department.', value: 'department' },
                { text: 'Access Level', value: 'accessLevel' },
            ],

        }
    },

    methods: {
        deleteSub:function (StaffObject){
            this.$inertia.post('/SubRole/delete/'+ StaffObject.id)
        },
        updateSub:function (StaffObject){
            this.$inertia.post('/SubRole/edit/',StaffObject)
        }


}
}
</script>

<style scoped>

</style>
