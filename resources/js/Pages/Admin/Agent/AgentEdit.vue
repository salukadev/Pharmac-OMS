<template>
    <Layout title="Agents">
        <v-app>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Add Agent</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
        <div>
            <form @submit.prevent="update(agent)">

                <label for="id">User Id:</label><br>
                <input type="text" id="id" name="userid"  v-model="agent.id" readonly><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="userid"  v-model="agent.email" required><br>

                <label for="userName">User Name:</label><br>
                <input type="text" id="userName" name="name"  v-model="agent.userName" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="name"  v-model="agent.password" required><br><br>

                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"  v-model="agent.name"><br><br>

                <label for="telephone">Telephone:</label><br>
                <input type="text" id="telephone" name="telephone" v-model="agent.telephone"><br><br>

                <label for="NIC">NIC:</label><br>
                <input type="text" id="NIC" name="NIC" v-model="agent.NIC"><br><br>

                <label for="BlacklistStatus">Blacklist Status:</label><br>
                <input type="text" id="BlacklistStatus" name="BlacklistStatus" v-model="agent.BlacklistStatus"><br><br>

                <v-btn color="blue" dark ><input type="submit" value="Update"></v-btn>
            </form>


        </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
        </div>
        </v-app>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

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
                email:'agent.email',
                userName:'agent.userName',
                password:'agent.password',
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
