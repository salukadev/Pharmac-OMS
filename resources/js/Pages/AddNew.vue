<template>
    <Layout>
        <div>
            <form id="addForm" @submit.prevent="submit()">
                <h5>Stock ID</h5>
                    <input v-model="form.stock_id" type="text" id="sId" placeholder="Enter the Stock ID"><br>
                <h5>Product Name</h5>
                    <input v-model="form.name" type="text" id="name" placeholder="Enter the Product Name"><br>
                <h5>Image</h5>
                    <input @input="form.imagePath = $event.target.files[0]" type="file" id="imagePath">
                <h5>Unit Price</h5>
                    <input v-model="form.unitPrice" type="number" id="uId" placeholder="Enter the Unit Price"><br>
                <h5>Discount ID</h5>
                    <input v-model="form.discount_id" type="text" id="Did" placeholder="Enter the Discount ID"><br>
                <button type="submit">Submit</button>
            </form>

        </div>
    </Layout>
</template>

<script>
import Layout from '../Shared/Layout'

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
