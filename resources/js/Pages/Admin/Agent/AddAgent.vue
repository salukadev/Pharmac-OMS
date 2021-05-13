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
            <form @submit.prevent="submit">
<!--                <label for="userid">User Id:</label><br>-->
<!--                <input type="text" id="userid" name="userid"  v-model="form.id"><br>-->

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="userid"  v-model="form.email" required><br>

                <label for="userName">User Name:</label><br>
                <input type="text" id="userName" name="name"  v-model="form.userName" required><br><br>

                <label for="password">Password:</label><br>
                <input type="text" id="password" name="name"  v-model="form.password" required><br><br>

                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"  v-model="form.name" required><br><br>

                <label for="tele">Telephone:</label><br>
                <input type="text" id="tele" name="tele" v-model="form.telephone" required><br><br>

                <label for="nic">NIC:</label><br>
                <input type="text" id="nic" name="nic" v-model="form.NIC" required><br><br>

                <label for="blkList">Blacklist Status:</label><br>
                <input type="text" id="blkList" name="blkList" v-model="form.BlacklistStatus" required><br><br>

                <v-btn color="blue" dark ><input type="submit" value="Submit"></v-btn>
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
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
export default {
    name: "AddAgent",
    components:{
        Layout,
    },
    // data() {
    //     return {
    //         form: {
    //             user_id:'',
    //             name:'',
    //             telephone:'',
    //             NIC:'',
    //             BlacklistStatus:''
    //         }
    //     }
    // },
    //
    // methods: {
    //     createAgent(data) {
    //         alert('Hello')
    //         this.$inertia.post('/agentDetails/store', data).then(()=>{});
    //     },
    // },
    // setup () {
    //     const form = useForm({
    //         userid:null,
    //         name:null,
    //         tele:null,
    //         blkList:null,
    //     })
    //
    //     return { form }
    // },
    // setup () {
    //     const form = reactive({
    //         email:null,
    //         userName:null,
    //         password:null,
    //         name:null,
    //         telephone:null,
    //         NIC:null,
    //         BlacklistStatus:null
    //     })
    //
    //     function submit() {
    //         Inertia.post('/agentDetails/store', form)
    //     }
    //
    //     return { form, submit }
    // },
    data() {
        return {
            form: {
                email:null,
                userName:null,
                password:null,
                name:null,
                telephone:null,
                NIC:null,
                BlacklistStatus:null
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/agentDetails/store', this.form)
        },
    },

}

</script>

