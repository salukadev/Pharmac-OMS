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
                                <h4 class="card-title">Product Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>


            <v-card>
            <div >
                <a href="product/create" class="btn btn-primary ">Add New Product</a>

            </div>
            <v-data-table
                :headers="headers"
                :items="lists"
                :search="search"
                class="table-striped table-no-bordered table-hover dataTable"
            >


                <template v-slot:item="row">
                    <!--display data-->
                    <tr>

                        <td>{{row.item.id}}</td>
                        <td>{{row.item.stock_id}}</td>
                        <td>{{row.item.name}}</td>
                        <td> <img class="pic" v-bind:src="row.item.imagePath"></td>
                        <td>{{row.item.unitPrice}}</td>
                        <td>{{row.item.discount_id}}</td>

                        <td>
                            <v-btn  color="error" dark @click="edit(row.item) ">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn color="success" dark @click="deleteProduct(row.item.id)">
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
import Layout from "../Shared/Admin/Layout";

export default {
    components: {
        Layout,
    },
    props: ['lists'],
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
                //{text: 'Product ID', value: 'id'},
                {text: 'Stock ID', value: 'stock_id'},
                {text: 'Name', value: 'name'},
                {text: 'Image', value: 'imagePath'},
                {text: 'Unit Price', value: 'unitPrice'},
                {text: 'Discount ID', value: 'discount_id'},
                {text: 'Actions', value: 'actions'},
            ],
        }
    },


    methods: {
        edit:function(data){
          this.$inertia.post('/editProduct',data)
        },
        deleteProduct:function (data){
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
                    this.$inertia.post('/deleteProduct/'+data)
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
