<template>
    <Layout title="Products">
        <v-app>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Add Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">

                            </div>
        <div>
            <form @submit.prevent="submit">

                        <label for="name">Name</label>
                        <input class="form-control" required id="name" v-model="form.name"/><br><br>


                        <label for="category">Category</label>
                        <input class="form-control" required id="category" v-model="form.category_id"/><br><br>


                        <label for="brand">Brand</label>
                        <input class="form-control" required id="brand" v-model="form.brand"/><br><br>


                        <label for="quantity">Quantity</label>
                        <input type='number' class="form-control" required id="quantity" v-model="form.quantity"/><br><br>


                        <label for="unitPrice">Unit Price</label>
                        <input type='number' class="form-control" required id="unitPrice" v-model="form.unitPrice"/><br><br>


                        <label for="mfd">MFD</label>
                        <input type='date' class="form-control" required id="mfd" v-model="form.mnfDate"/><br><br>


                        <label for="exp">EXP</label>
                        <input type='date' class="form-control" required id="exp" v-model="form.expDate"/><br><br>


                        <label for="supplier">Supplier</label>
                        <input class="form-control" required id="supplier" v-model="form.supplier_id"/><br><br>


                        <label for="batchNo">Batch Number</label>
                        <input class="form-control" required id="batchNo" v-model="form.batchNo"/><br><br>


                <v-btn color="blue" dark ><input type="submit" value="Submit"></v-btn>
            </form>
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
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
export default {
    name: "AddProduct",
    components:{
        Layout,
    },
    data() {
        return {
            form: {
                name: null,
                category_id: null,
                brand: null,
                quantity: null,
                unitPrice: null,
                mnfDate: null,
                expDate: null,
                supplier_id: null,
                batchNo: null
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/stock/store', this.form)
        },
    },

}

</script>

