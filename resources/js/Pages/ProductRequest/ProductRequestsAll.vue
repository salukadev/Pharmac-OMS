<template>
    <Layout>
        <div>
            Product request Details
            <inertia-link :href="`/productRequest/add`">Add Product Request</inertia-link>
            <table border="1">
                <tr>
                    <th>Request ID</th>
                    <th>User ID</th>
                    <th>Generic</th>
                    <th>Brand</th>
                    <th>Description</th>
                </tr>

<!--                printing the product requests-->
                <tr v-for="request in productRequests" :key="request.reqestId">
                    <td>{{ request.reqestId }}</td>
                    <td>{{ request.user_id }}</td>
                    <td>{{ request.generic }}</td>
                    <td>{{ request.brand }}</td>
                    <td>{{ request.description }}</td>
<!--                    <td>-->
<!--                        &lt;!&ndash;                       <inertia-link :href="`/agentDetails/edit`" method="post" :data="{agent:Agent}">Edit</inertia-link>&ndash;&gt;-->
<!--                        <button @click="edit(Agent)">Edit</button>-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        <button><inertia-link :href="`/agentDetails/delete/${ Agent.id }`" method="post">Delete</inertia-link></button>-->
<!--                    </td>-->
                </tr>


            </table>

        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout";

export default {
    name: "ProductRequestsAll",
    components:{
        Layout,
    },
    props:{
        productRequests:Array,
    }
}
</script>

<style scoped>

</style>
