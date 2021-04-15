<template>
    <Layout>
        <div>
            Agents Details
            <inertia-link :href="`/agentDetails/add`">Add Agent</inertia-link>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>NIC</th>
                </tr>

                <tr v-for="Agent in agents" :key="Agent.id">
                    <td>{{ Agent.id }}</td>
                    <td>{{ Agent.name }}</td>
                    <td>{{ Agent.telephone }}</td>
                    <td>{{ Agent.NIC }}</td>
                    <td>
<!--                       <inertia-link :href="`/agentDetails/edit`" method="post" :data="{agent:Agent}">Edit</inertia-link>-->
                       <button @click="edit(Agent)">Edit</button>
                     </td>
                     <td>
                         <button><inertia-link :href="`/agentDetails/delete/${ Agent.id }`" method="post">Delete</inertia-link></button>
                     </td>
                 </tr>

             </table>

         </div>
     </Layout>
 </template>

 <script>
 import Layout from "../../Shared/Layout";

 export default {
     name: "AgentDetails",
     components:{
         Layout,
     },
     props:{
        agents:Array,
        agent: Object,
     },
     methods:{
         edit:function (data){
             console.log("hello")
             this.$inertia.post('/agentDetails/edit', data)
         },

     }
 }
 </script>
