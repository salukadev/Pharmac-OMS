
<template>
    <Layout>
    <div >
        <h2>Complaints</h2>
        <table border="1px">
           
                <tr>
                    <th>ComplaintId</th>
                    <th>User_id</th>
                    <th>Category</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>   

            <tbody>
               
                <tr v-for="co in complaints" :key="co.complaintId" >
                <td>{{co.complaintId}}</td>
                <td>{{co.user_id}}</td>
                <td>{{co.category}}</td>
                <td>{{co.message}}</td>
                <td>{{co.status}}</td>

                <td>
                    <button @click="edit(co)">Edit</button>
                    <button @click="deleteComplaint(co.complaintId)">Delete</button>
                </td>
                </tr>

            </tbody> 
        </table>
    </div>
    </Layout>

</template>

<script>
import Layout from '../../Shared/Layout'               

export default {
    components:{
        Layout,
    },
    props:['complaints'],

    methods:{
        edit:function(data){
            this.$inertia.post('/editComplaint', data)
        },

        deleteComplaint:function(data){
            this.$inertia.post('/deleteComplaint/'+ data)
        },
    }
}
</script>