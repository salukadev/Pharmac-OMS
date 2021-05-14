<template>
    <Layout>
        <v-app>
        <div>
            <h2>Complaints</h2>
            <div class="container">
                
            <form @submit.prevent="update(complaint)" class="col-lg offset-lg-3">
                    
                     <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">Complaint Id</label>
                        <div class="col-sm-10"></div><input type="text" class="form-control" id="formGroupExampleInput" placeholder="Complaint ID" v-model="complaint.complaintId" readonly>
                     </div>

                    
                    <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">userID</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="userID" v-model="complaint.user_id" required>
                     </div><br>


                    <div class="form-group col-md-5">
                       
                           <!--<label for="formGroupExampleInput">Category</label> -->
                        
                            <select class="form-control" id="inputGroupSelect01" v-model="complaint.category">
                                <option selected></option>
                                <option value="Products">About Med Products</option>
                                <option value="Agent">About Agent</option>
                                <option value="Delivery Services">About Delivery Service</option>
                                <option value="other">Other</option>
                            </select>
                    </div><br>

                    <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">Message</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Message" v-model="complaint.message">
                     </div><br>

                   
                    <button button type="submit" class="btn btn-behance mb-2">Update</button>
                
            </form>
            
            </div>
            

             
        </div>
        </v-app>
    </Layout>
</template>

<script>

import Layout from '../../../Shared/Admin/Layout.vue'

export default {
    
    components:{
        Layout,
    
    },
    props:['complaint'],

    data(){
        return{
            form:{
                complaintId:'complaint.complaintId',
                user_id:'complaint.user_id',
                category:'complaint.category',
                message:'complaint.message',
            }
        }
    },  

    methods:{
        update:function(data){
            this.$inertia.post('/updateComplaint',data);
        }


    }
    
}
</script>