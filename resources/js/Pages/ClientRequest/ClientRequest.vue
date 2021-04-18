<template>
    <Layout>
        <div>
            <h2>Client Request</h2><br>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam quas alias optio dolor, facere, officiis maiores, minus eligendi mollitia unde exercitationem 
            quibusdam? Nesciunt veniam voluptas ipsum vero maiores nisi nobis?</p>
            
               <form @submit.prevent="submit">
                   <label for="name">Name</label><br>
                   <input type="text" v-model="form.name">

                   <label for="contact_number">Contact Number</label><br>
                   <input type="text" v-model="form.telephone">

                   <label for="business_address">Business Address</label><br>
                   <input type="text" v-model="form.address">

                   <label for="email">Email</label><br>
                   <input type="text" v-model="form.email">

                   <label for="customer_type">Customer Type</label><br>
                   <input type="text" v-model="form.customerType">

                   <button type="submit">submit</button>
                   <button type="cancle">cancle</button>

               </form>

              
        </div>

    </Layout>
</template>

<script>

import Layout from '../../Shared/Layout.vue'

export default {
    
    components:{
        Layout,
    
    },

     methods:{
        submit:function(){
            this.$inertia.post('/add',this.form);
        }
    }

}
</script>