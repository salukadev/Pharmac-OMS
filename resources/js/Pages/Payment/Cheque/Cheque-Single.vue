<template>
    <Layout>
        <div>
            <img class="thubnailImg" v-bind:src="cheque.frontImg">
            <img class="thubnailImg" v-bind:src="cheque.backImg">
            <h1>Check Number :{{cheque.chequeNo}}</h1>
            <h1>Payment Id :{{cheque.payment_id}}</h1>
            <h1>Agent note :{{cheque.agent_Note}}</h1>
            <h1>Agent Id :{{cheque.agent_id}}</h1>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Layout'

export default {
    components:{
        Layout,
    },
    props:['cheque'],
}
</script>

<style scoped>
.thubnailImg{
    width: 400px;
    height: 400px;
}
</style>
