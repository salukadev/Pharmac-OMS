<template>
    <Layout>
        <div>
            <form @submit.prevent="submit">
                
                <input type="number" v-model="form.order_id" placeholder="Order Id">
                <input type="text" v-model="form.reason" placeholder="Reason">
                <input type="text" v-model="form.type" placeholder="Type">
                <input type="file"   @input="form.images = $event.target.files[0]">              
                <button id="btnSubmit" type="submit">Submit</button>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Shared/Layout'
export default {
    components:{
        Layout,
    },
    props:['errors']
    ,
    data(){
        return{
            form:{
                order_id:null,
                reason:null,
                type:null,
                images:null,
            }
        }
    },
    methods:{
        submit:function (){
            this.$inertia.post('/return_request',this.form);
        }
    }
}
</script>