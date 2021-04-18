<template>
    <Layout>
        <div> <center>
            <h2>Complaints</h2>
            <form @submit.prevent="update(complaint)">

                     <label>Complaint Id</label>
                     <input type="text" placeholder="Complaint ID" v-model="complaint.complaintId" readonly><br>

                    <label>userID</label>
                    <input type="text" placeholder="userID" v-model="complaint.user_id"><br>

                    <label>Category</label>
                    <select id="category" name="category" v-model="complaint.category">
                        <option value="Products">About Med Products</option>
                        <option value="Agent">About Agent</option>
                        <option value="Delivery Services">About Delivery Service</option>
                        <option value="other">Other</option>
                    </select><br>

                    <label>Message</label>
                    <input type="text" placeholder="Enter Message" v-model="complaint.message"><br><br>
                   
                    <button type="submit">Update</button>
            </form>

              </center>
        </div>

    </Layout>
</template>

<script>

import Layout from '../../Shared/Layout.vue'

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