<template>
    <Layout>
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">list_alt</i>
                                </div>
                                <h4 class="card-title">Discount Plan</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>


                                <v-card>
                                    <div style="text-align: right; padding: 20px">
                                        <v-btn color="card-header-primary" dark href="discount/create">
                                            <v-icon dark>add</v-icon>
                                            Add Discount Plans
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
                                        :items="discounts"
                                        :search="search"
                                        class="table-striped table-no-bordered table-hover dataTable"
                                    >


                                        <template v-slot:item="row">
                                            <!--display data-->
                                            <tr>

                                                <td>{{row.item.id}}</td>
                                                <td>{{row.item.itemCount}}</td>
                                                <td>{{row.item.freeItem}}</td>

                                                <td>
                                                    <v-btn  color="green" dark @click="edit(row.item) ">
                                                        <v-icon>edit</v-icon>
                                                    </v-btn>
                                                    <v-btn color="error" dark @click="deleteDiscount(row.item.id)">
                                                        <v-icon>delete</v-icon>
                                                    </v-btn>

                                                </td>

                                            </tr><!-- end of display data-->
                                        </template>

                                    </v-data-table>
                                </v-card>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </v-app>

    </Layout>

</template>

<script>
import Layout from "../../../Shared/Admin/Layout";

export default {
    components: {
        Layout,
    },
    props: ['discounts'],
    data() {
        return {
            search: '',
            headers: [

                {
                    text: 'ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                //{text: 'Discount ID', value: 'id'},


                {text: 'Item Count', value: 'itemCount'},
                {text: 'Free Item', value: 'freeItem'},
                {text: 'Actions', value: 'actions'},

            ],
        }
    },


    methods: {
        edit:function(data){
            this.$inertia.post('/editDiscount',data)
        },
        deleteDiscount:function (data){
            this.$swal.fire({
                title: 'Are you sure?',
                text: "Do you want to Delete this Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#13895a',
                cancelButtonColor: '#9a9292',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post('/deleteDiscount/'+data)
                }
            })

        },

    }
}
</script>
<style scoped>
.pic{
    width:100px;
    height: 100px;
}
</style>
