<template>
    <Layout>
        <div>
            <table border="1">
                <thead>
                    <th>Cheque Number</th>
                    <th>Payment Id</th>
                    <th>Agent Id</th>
                    <th>Cheque Date</th>
                    <th>Submit Date</th>
                    <th>Front Img</th>
                    <th>Back Img</th>
                    <th>Remark</th>
                    <th>Status</th>
                    <th>Agent Note</th>
                </thead>
                <tbody>
                <!--display data-->
                    <tr v-for="cheque in cheques">

                        <td>{{cheque.chequeNo}}</td>
                        <td>{{cheque.payment_id}}</td>
                        <td>{{cheque.agent_id}}</td>
                        <td>{{cheque.chequeDate}}</td>

                        <td>{{cheque.created_at}}</td>
                        <td> <img class="thubnailImg" v-bind:src="cheque.frontImg"> </td>
                        <td> <img class="thubnailImg" v-bind:src="cheque.backImg"> </td>
                        <td>{{cheque.remark}}</td>
                        <td>{{cheque.status}}</td>
                        <td>{{cheque.agent_Note}}</td>
                    </tr><!-- end of display data-->
                </tbody>
            </table>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Layout'

export default {
    components:{
        Layout,
    },
    props:['cheques'],
}
</script>
<style scoped>
.thubnailImg{
    width: 100px;
    height: 100px;
}
</style>
