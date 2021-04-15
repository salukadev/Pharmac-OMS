<template>
    <Layout>
        <div>
            <form @submit.prevent="update(agent)">
                <label for="id">User Id:</label><br>
                <input type="text" id="id" name="userid"  v-model="agent.id" readonly><br>

                <label for="userid">User Id:</label><br>
                <input type="text" id="userid" name="userid"  v-model="agent.user_id" readonly><br>

                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"  v-model="agent.name"><br><br>

                <label for="tele">Telephone:</label><br>
                <input type="text" id="tele" name="tele" v-model="agent.telephone"><br><br>

                <label for="nic">NIC:</label><br>
                <input type="text" id="nic" name="nic" v-model="agent.NIC"><br><br>

                <label for="blkList">Blacklist Status:</label><br>
                <input type="text" id="blkList" name="blkList" v-model="agent.BlacklistStatus"><br><br>

               <button type="submit" >Update</button>
            </form>

<!--            <h1>{{agent.id}}</h1>-->
<!--            <h1>{{agent.user_id}}</h1>-->
<!--            <h1>{{agent.name}}</h1>-->

        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout";

export default {
    name: "AgentEdit",
    components:{
        Layout,
    },
    props:['agent'],
    data() {
        return {
            form: {
                id: 'agent.id',
                user_id: 'agent.user_id',
                name: 'agent.name',
                telephone: 'agent.telephone',
                NIC: 'agent.NIC',
                BlacklistStatus: 'agent.BlacklistStatus',
            }
        }
    },
    methods:{
      update:function (data){
          this.$inertia.post('/agentDetails/update', data)
      }
    }
}
</script>

<style scoped>

</style>
