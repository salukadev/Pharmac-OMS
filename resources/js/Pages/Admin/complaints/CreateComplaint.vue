<template>
    <Layout>
        <v-app> <center>
            <h2>Complaints</h2>
            <div class="container">


 <!-- getting inputs by form-->

            <form @submit.prevent="submit">

                 <!-- getting user ID by form-->

                    <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">User Id</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="UserID" v-model="form.user_id" required >
                     </div>

                 <!-- getting category by form-->

                    <div class="input-group col-md-5">
                        <div class="formGroupExampleInput">
                            <label class="input-group-text" for="inputGroupSelect01">Category</label>
                        </div>
                         <!-- getting user nput by dropdown -->
                        <select class="custom-select" id="inputGroupSelect01" v-model="form.category" required>
                                <option selected></option>
                                <option value="Products">About Med Products</option>
                                <option value="Agent">About Agent</option>
                                <option value="Delivery Services">About Delivery Service</option>
                                <option value="other">Other</option>
                        </select>
                     </div>

                <!-- getting user message by form-->

                   <div class="form-group col-md-5">
                        <label for="formGroupExampleInput">Message</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Message" v-model="form.message" required>
                     </div><br>

                <!--submit button-->
                    <button type="submit" class="btn btn-behance mb-2">Submit</button>
            </form>
            </div>
            </center>
        </v-app>
    </Layout>
</template>

<script>

import Layout from '../../../Shared/Admin/Layout.vue'

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
