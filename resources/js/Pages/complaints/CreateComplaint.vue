<template>
    <Layout>
        <div> <center>
            <h2>Complaints</h2>
            <form @submit.prevent="submit">

                    <label>userID</label>
                    <input type="text" placeholder="userID" v-model="form.user_id"><br>

                    <label>Category</label>
                    <select id="category" name="category" v-model="form.category">
                        <option value="Products">About Med Products</option>
                        <option value="Agent">About Agent</option>
                        <option value="Delivery Services">About Delivery Service</option>
                        <option value="other">Other</option>
                    </select><br>

                    <label>Message</label>
                    <input type="text" placeholder="Enter Message" v-model="form.message"><br><br>

                    <button type="submit">Submit</button>
            </form>

              </center>
        </div>

    </Layout>
</template>

<script>

import Layout from '../../Shared/Admin/Layout'

export default {

    components:{
        Layout,

    },

    data(){
        return{
            form:{
                user_id:'',
                category:'',
                message:'',
            }
        }
    },

    methods:{
        submit:function(){
            this.$inertia.post('/addComplaint',this.form);
        }
    }

}
</script>
