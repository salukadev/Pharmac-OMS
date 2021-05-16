<template>
    <Layout title="Discount">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">local_offer</i>
                                </div>
                                <h4 class="card-title">Edit Discount Plan</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>

                                <div>
                                    <form @submit.prevent="update()">

                                        <v-text-field
                                            v-model="form.itemCount"
                                            :counter="10"
                                            label="Item Count"

                                        ></v-text-field>

                                        <v-text-field
                                            v-model="form.freeItem"
                                            :counter="10"
                                            label="Free Items"

                                        ></v-text-field>

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
import Layout from "../../../Shared/Admin/Layout";
export default {
    components:{
        Layout,
    },
    props:['discount'],
    data(){
        return{
            form:{
                id:this.discount.id,
                itemCount:this.discount.itemCount,
                freeItem:this.discount.freeItem,

            }
        }
    },
    methods:{
        update:function (){
            this.$inertia.post('/discount/update',this.form);
        }
    }
}
</script>
