<template>
        <v-dialog max-width="600px">
                    <v-btn color="blue" dark href="/stock/add">
                    <v-icon dark>add</v-icon>
                    Add Product
                    </v-btn>

                    <v-card>
                        <v-card-title>Add Product</v-card-title>
                    <div>
                        <form @submit.prevent="submit(stock)">

                            <label for="name">Name</label>
                            <input class="form-control" required id="name" v-model="form.name"/><br><br>


                            <label for="category">Category</label>
                            <input class="form-control" required id="category" v-model="form.category_id"/><br><br>


                            <label for="brand">Brand</label>
                            <input class="form-control" required id="brand" v-model="form.brand"/><br><br>


                            <label for="quantity">Quantity</label>
                            <input type='number' class="form-control" required id="quantity" v-model="form.quantity"/><br><br>


                            <label for="unitPrice">Unit Price</label>
                            <input type='number' step="0.01" class="form-control" required id="unitPrice" v-model="form.unitPrice"/><br><br>


                            <label for="mfd">MFD</label>
                            <input type='date' class="form-control" required id="mfd" v-model="form.mnfDate"/><br><br>


                            <label for="exp">EXP</label>
                            <input type='date' class="form-control" required id="exp" v-model="form.expDate"/><br><br>


                            <label for="supplier">Supplier</label>
                            <input class="form-control" required id="supplier" v-model="form.supplier_id"/><br><br>


                            <label for="batchNo">Batch Number</label>
                            <input class="form-control" required id="batchNo" v-model="form.batchNo"/><br><br>

                    <v-btn color="blue" dark ><input type="submit" value="submit"></v-btn>
                    </form>
                    </div>
                    </v-card>

                </v-dialog>
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
                name: null,
                category_id: null,
                brand: null,
                quantity: null,
                unitPrice: null,
                mnfDate: null,
                expDate: null,
                supplier_id: null,
                batchNo: null
            }
        }
    },
    methods:{
      submit:function (data){
          this.$inertia.post('/stock/store', this.form)
      }
    }
}
</script>

<style scoped>

</style>
