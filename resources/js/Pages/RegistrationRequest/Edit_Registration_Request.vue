<template>

        <Layout title="Registration Request">
            <v-app>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">assignment</i>
                                    </div>
                                    <h4 class="card-title">Create Registration Request</h4>
                                </div>
                                <div class="card-body">
                                    <div class="toolbar">

                                </div>
                                    <div>
                                        <form @submit.prevent="update(Reg)">

                                            <v-container>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="6" md="3">
                                                            <v-text-field
                                                                outlined
                                                                v-model="Reg.name"
                                                                label="Name"
                                                                readonly
                                                            ></v-text-field>
                                                        </v-col>

                                                        <v-col cols="6" md="3">
                                                            <v-text-field
                                                                outlined
                                                                v-model="Reg.address"
                                                                label="Address"
                                                                readonly
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>

                                                <v-col cols="6">
                                                    <v-text-field
                                                        outlined
                                                        v-model="Reg.cusType"
                                                        label="Customer Type"
                                                        readonly
                                                    ></v-text-field>
                                                </v-col>

                                                <v-col cols="6">
                                                    <v-text-field
                                                        outlined
                                                        v-model="Reg.telephone"
                                                        label="Phone Number:"
                                                        readonly

                                                    ></v-text-field>
                                                </v-col>

                                                <v-card-title>Update the status</v-card-title>
                                                <v-divider class="mx-4"></v-divider>

                                                <v-card-text>
                                                    <v-col cols="6">
                                                        <v-select
                                                            v-model="Reg.status"
                                                            :items="it"
                                                            label="Select"

                                                        >
                                                        </v-select>
                                                    </v-col>
                                                </v-card-text>


                                                <v-divider class="mx-4"></v-divider>

                                               <v-btn color="blue" dark ><input type="submit" value="Submit"></v-btn>

                                                </v-container>
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
import Layout from "../../Shared/Admin/Layout";

export default {


    components:{
        Layout,

    },
    props:['Reg'],

    data(){
        return{
            form:{
                name:'Reg.name',
                address:'Reg.address',
                cusType:'Reg.cusType',
                message:'Reg.telephone',
                status:'Reg.status',
            },

            it:[
                'Processing',
                'Accept Request',
                'Reject',
            ]
        }
    },

    methods:{
        update:function(data){
            this.$inertia.post('/updateRegistrationRequest',data);
        }


    }


}
</script>

<style scoped>

</style>
