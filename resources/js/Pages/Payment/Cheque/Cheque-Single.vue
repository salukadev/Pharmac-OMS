<template>
    <Layout>
        <div>
            <form @submit.prevent="">
                <label for="frontImg">Front Image :</label>
                <img v-bind:src="cheque.frontImg" class="thubnailImg">
                <input type="file" @input="form.frontImg = $event.target.files[0]"> <br>
                <label for="backImg">Front Image :</label>
                <img v-bind:src="cheque.backImg" class="thubnailImg">
                <input type="file" @input="form.backImg = $event.target.files[0]"> <br>
                <input type="number" v-model="form.chequeNo">
                <input type="number" v-model="form.payment_id">
                <input type="date" v-model="form.chequeDate">
                <input type="text" v-model="form.remark" readonly>
                <input type="number" v-model="form.agent_id" readonly>
                <input type="text" v-model="form.agent_Note" readonly>
                <input type="text" v-model="form.created_at" readonly>
                <input type="text" v-model="form.updated_at" readonly> <br>
                <label for="admin_Note">Admin Note :</label>
                <input type="text" v-model="form.admin_Note">
                <input type="text" v-model="form.admin_id" hidden>
                <input type="text" v-model="form.id" hidden>
                <button @click="accept">Accept</button>
                <button @click="reject">Reject</button>
                <button @click="update">Update</button>
                <button @click="delete">Delete</button>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Layout'

export default {
    components: {
        Layout,
    },
    data() {
        return {
            form: {
                id:this.cheque.id,
                chequeNo: this.cheque.chequeNo,
                payment_id: this.cheque.payment_id,
                chequeDate: this.cheque.chequeDate,
                remark: this.cheque.remark,
                agent_id: this.cheque.agent_id,
                agent_Note: this.cheque.agent_Note,
                frontImg: this.cheque.frontImg,
                backImg: this.cheque.backImg,
                created_at: this.cheque.created_at,
                updated_at: this.cheque.updated_at,
                admin_Note: null,
                admin_id: null
            }
        }
    },
    props: ['cheque'],
    methods: {
        accept: function () {
            this.$inertia.put('/approve/' + this.cheque.id)
        },
        reject: function () {
            this.$inertia.put('/reject/' + this.cheque.id)
        },
        update: function () {
            this.$inertia.post('/update', this.form)
        },
        delete: function () {
            this.$inertia.delete('/delete/' + this.form.id)
        }
    }
}
</script>

<style scoped>
.thubnailImg {
    width: 400px;
    height: 400px;
}
</style>
