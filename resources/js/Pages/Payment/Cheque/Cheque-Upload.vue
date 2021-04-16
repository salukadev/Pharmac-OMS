<template>
    <Layout>
        <div>
            <p v-for="error in errors">{{error}}</p>
            <form @submit.prevent="submit">
                <input type="file"   @input="form.frontImg = $event.target.files[0]">
                <input type="file"   @input="form.backImg = $event.target.files[0]">
                <input type="number" v-model="form.chequeNo" placeholder="Enter Cheque Nummber">
                <input type="number" v-model="form.payment_id"  placeholder="Enter Payment Id">
                <input type="date" v-model="form.chequeDate" placeholder="Date of Cheque">
                <input type="text" v-model="form.remark" placeholder="Add Remark Here">
                <input type="number" v-model="form.agent_id" placeholder="Agent Id">
                <input type="text" v-model="form.agent_Note" placeholder="Agent note">
                <button id="btnSubmit" type="submit">Submit</button>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Layout'

export default {
    components:{
        Layout,
    },
    props:['errors']
    ,
    data(){
        return{
            form:{
                chequeNo: null,
                payment_id: null,
                chequeDate: null,
                remark: null,
                agent_id: null,
                agent_Note: null,
                frontImg: null,
                backImg: null,
            }
        }
    },
    methods:{
        submit:function (){
            this.$inertia.post('/upload/store',this.form);
        }
    }

}
</script>
