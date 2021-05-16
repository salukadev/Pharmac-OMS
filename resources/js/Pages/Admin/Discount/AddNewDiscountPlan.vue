<template>
    <Layout title="Category">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">local_offer</i>
                                </div>
                                <h4 class="card-title">Add New Discount Plan</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">

                                </div>

                                <div>
                                    <form @submit.prevent="submit(discount)">

                                        <v-text-field
                                            v-model="form.itemCount"
                                            :counter="10"
                                            label="Item Count"
                                            rules="required|max:50"
                                            :rules="itmCountRule"
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="form.freeItem"
                                            :counter="10"
                                            label="Free Items"
                                            rules="required|max:50"
                                            :rules="freeItemRule"
                                        ></v-text-field>

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
import Layout from "../../../Shared/Admin/Layout";
export default {
    components:{
        Layout,
    },
    props:[],
    data(){
        return{
            form:{
                itemCount:null,
                freeItem:null,

            },
            itmCountRule: [
                v => !!v || 'Item count filed is required',
            ],
            freeItemRule: [
                v => !!v || 'Free Item filed is required',
            ],


        }
    },
    methods:{
        submit:function (){
            this.$inertia.post('/discount/add',this.form);
        }
    }
}
</script>
