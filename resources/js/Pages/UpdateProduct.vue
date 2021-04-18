<template>
    <Layout>
        <div>
            <div>
                <h1>hello</h1>

            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../Shared/Layout'

export default {
    components:{
        Layout,
    },
    props:['products'],
    data(){
        return{
            form:{
                stock_id:'products.stock_id',
                name:'products.name',
                imagePath:'products.imagePath',
                unitPrice:'products.unitPrice',
                discountId:'products.discount_id',
            }
        }
    },
}
</script>


