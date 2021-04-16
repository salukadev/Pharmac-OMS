<template>
    <Layout>
        <div>
            <form @submit.prevent="submit">
                <label for="userid">User Id :</label><br>
                <input type="text" id="userid" name="userid"  v-model="form.user_id"><br>

                <label for="name">Generic :</label><br>
                <input type="text" id="name" name="name"  v-model="form.generic"><br><br>

                <label for="tele">Brand :</label><br>
                <input type="text" id="tele" name="tele" v-model="form.brand"><br><br>

                <label for="nic">Description:</label><br>
                <input type="text" id="nic" name="nic" v-model="form.description"><br><br>

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
    name: "AddProductRequest",
    components:{
        Layout,
    },
    setup () {
        const form = reactive({
            user_id:null,
            generic:null,
            brand:null,
            description:null,
        })

        function submit() {
            Inertia.post('/productRequest/store', form)
        }

        return { form, submit }
    },

}
</script>

<style scoped>

</style>
