<template>
    <Layout title="Category">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Add Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>

                                <div>
                                    <form @submit.prevent="submit(categories)">

                                        <label for="order_id">Order ID</label>
                                        <input class="form-control" required id="order_id" v-model="form.order_id"/><br><br>

                                        <label for="reason">Reason</label>
                                        <input class="form-control" required id="reason" v-model="form.reason"/><br><br>

                                        <label for="type">Type</label>
                                        <input class="form-control" required id="type" v-model="form.type"/><br><br>
                                        <v-btn color="blue" dark ><input type="submit" value="submit"></v-btn>
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
    name: "AddReturnRequest",
    components:{
        Layout,
    },
    props:['product_returns'],
    data() {
        return {
            form: {
                order_id: null,
                reason:null,
                type:null,
            }
        }
    },
    methods:{
        submit:function (data){
            this.$inertia.post('/return/store', this.form)
        }
    }
}
</script>

<style scoped>
</style>
