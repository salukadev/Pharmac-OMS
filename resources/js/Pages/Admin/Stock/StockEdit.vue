<template>
    <Layout title="Product">
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
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>

                    <div>
                        <form @submit.prevent="update(stock)">

                            <label for="name">Name</label>
                            <input class="form-control" required id="name" v-model="stock.name"/><br><br>


                            <label for="category">Category</label>
                            <input class="form-control" required id="category" v-model="stock.category.catName" readonly/><br><br>


                            <label for="brand">Brand</label>
                            <input class="form-control" required id="brand" v-model="stock.brand"/><br><br>


                            <label for="quantity">Quantity</label>
                            <input type='number' class="form-control" required id="quantity" v-model="stock.quantity"/><br><br>


                            <label for="unitPrice">Unit Price</label>
                            <input type='number' class="form-control" required id="unitPrice" v-model="stock.unitPrice"/><br><br>


                            <label for="mfd">MFD</label>
                            <input type='date' class="form-control" required id="mfd" v-model="stock.mnfDate"/><br><br>


                            <label for="exp">EXP</label>
                            <input type='date' class="form-control" required id="exp" v-model="stock.expDate"/><br><br>


                            <label for="supplier">Supplier</label>
                            <input class="form-control" required id="supplier" v-model="stock.supplier.supName" readonly/><br><br>


                            <label for="batchNo">Batch Number</label>
                            <input class="form-control" required id="batchNo" v-model="stock.batchNo"/><br><br>

                    <v-btn color="blue" dark ><input type="submit" value="Update"></v-btn>
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

export default {
    name: "StoreEdit",
    components:{
        Layout,
    },
    props:['stock'],
    data() {
        return {
            form: {
                name: 'stock.name',
                category_id: 'stock.category_id',
                brand: 'stock.brand',
                quantity: 'stock.quantity',
                unitPrice: 'stock.unitPrice',
                mnfDate: 'stock.mnfDate',
                expDate: 'stock.expDate',
                supplier_id: 'stock.supplier_id',
                batchNo: 'stock.batchNo'
            }
        }
    },
    methods:{
      update:function (data){
          this.$inertia.post('/stock/update', data)
      }
    }
}
</script>

<style scoped>

</style>
