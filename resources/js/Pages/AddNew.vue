<template>
    <Layout>
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">queue</i>
                            </div>
                            <h4 class="card-title">Add New Product</h4>
                        </div>



        <div>
            <v-card>
            <form id="addForm" @submit.prevent="submit()">
               <v-container>
                   <v-col
                       cols="20"
                       md="12"
                   >
                       <v-text-field
                           v-model="form.stock_id"
                           :counter="10"
                           label="Stock ID"
                           rules="required|max:50"
                       ></v-text-field>

                <v-text-field
                    v-model="form.name"
                    :counter="50"
                    label="Product Name"
                    rules="required|max:50"
                ></v-text-field>
                    <v-file-input
                        @input="form.imagePath = $event.target.files[0]"
                        label="File input"
                        filled
                        prepend-icon="mdi-camera"
                        v-model="form.imagePath"
                        rules="required|max:50"
                    ></v-file-input>

                <v-text-field
                    v-model="form.unitPrice"
                    :counter="50"
                    label="Unit Price"
                    rules="required|max:50"
                ></v-text-field>

                <v-text-field
                    v-model="form.discount_id"
                    :counter="50"
                    label="Discount ID"
                    rules="required|max:50"
                ></v-text-field>
                   </v-col>
                   <v-btn color="#FF80AB" type="submit" dark>Submit</v-btn>

               </v-container>


            </form>
            </v-card>


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
    components:{
        Layout,
    },
    props:[],
    data(){
        return{
            form:{
                stock_id:null,
                name:null,
                imagePath:null,
                unitPrice:null,
                discountId:null,
            }
        }
    },
    methods:{
        submit:function (){
            this.$inertia.post('/add',this.form);

        }

    }
}
</script>
