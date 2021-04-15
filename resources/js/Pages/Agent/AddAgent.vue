<template>
    <Layout>
        <div>
            <form @submit.prevent="submit">
                <label for="userid">User Id:</label><br>
                <input type="text" id="userid" name="userid"  v-model="form.user_id"><br>

                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"  v-model="form.name"><br><br>

                <label for="tele">Telephone:</label><br>
                <input type="text" id="tele" name="tele" v-model="form.telephone"><br><br>

                <label for="nic">NIC:</label><br>
                <input type="text" id="nic" name="nic" v-model="form.NIC"><br><br>

                <label for="blkList">Blacklist Status:</label><br>
                <input type="text" id="blkList" name="blkList" v-model="form.BlacklistStatus"><br><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout";
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
    setup () {
        const form = reactive({
            user_id:null,
            name:null,
            telephone:null,
            NIC:null,
            BlacklistStatus:null
        })

        function submit() {
            Inertia.post('/agentDetails/store', form)
        }

        return { form, submit }
    },

}

</script>

