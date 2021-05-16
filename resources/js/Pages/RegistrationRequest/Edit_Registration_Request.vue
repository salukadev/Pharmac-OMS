<template>

        <Layout title="Agents">
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
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div>
                                        <form @submit.prevent="update(Reg)">
                                            <!--                <label for="userid">User Id:</label><br>-->
                                            <!--                <input type="text" id="userid" name="userid"  v-model="form.id"><br>-->

                                            <label for="name">Name:</label><br>
                                            <input type="text" id="name" name="name"  v-model="Reg.name"  readonly><br>

                                            <label for="Address">Address:</label><br>
                                            <input type="text" id="Address" name="name"  v-model="Reg.address" readonly><br><br>

                                            <label for="customer_type">Customer Type:</label><br>
                                            <input type="text" id="customer_Type" name="name"  v-model="Reg.cusType" readonly><br><br>

                                            <label for="phone_number">Phone Number:</label><br>
                                            <input type="text" id="phone_number" name="name"  v-model="Reg.telephone" readonly><br><br>

                                            <label for="status">Status:</label><br>
                                            <select class="custom-select" id="status" v-model="Reg.status" >
                                                <option selected></option>
                                                <option value="Processing">Processing</option>
                                                <option value="Accept Request">Accept Request</option>
                                                <option value="Reject">Reject</option>
                                            </select><br><br>

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
            }
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
