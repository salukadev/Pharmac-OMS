<template>
    <Layout>
        <v-app>
            <div align="center">
                <div class="card mt-7 pb-5">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">subtitles</i>
                        </div>
                        <h4 align="left" class="card-title">Cheque No - {{ cheque.chequeNo }}</h4>

                        <v-card align="center" max-width="70%">
                            <v-alert
                                dense
                                text
                                type="success"
                                v-if="successMessage"
                            >
                                {{successMessage}}
                            </v-alert>
                            <p v-for="error in errors">
                                <v-alert
                                    dense
                                    outlined
                                    type="error"
                                >{{ error }}</v-alert></p>
                            <form @submit.prevent="update" class="pb-8">
                                <v-img
                                    v-bind:src="cheque.frontImg"
                                    contain
                                    max-width="100%"
                                    max-height="600px"
                                    class="grey darken-0"
                                ></v-img>
                                <v-card-title>
                                    <v-row>
                                        <v-col cols="9" sm="6">
                                            Front Image
                                        </v-col>
                                        <v-col cols="12" sm="4">
                                            <v-file-input
                                                @input="form.frontImg = $event.target.files[0]"
                                                @change="prev_frontImg"
                                                v-model="form.frontImg"
                                                label="Update Front Image"
                                                filled
                                                prepend-icon="mdi-camera"
                                            ></v-file-input>

                                        </v-col>
                                        <v-col>
                                            <v-img :src="frontImg" max-height="200px" max-width="100px"></v-img>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-img
                                    v-bind:src="cheque.backImg"
                                    contain
                                    max-width="100%"
                                    max-height="600px"
                                    class="grey darken-0"
                                ></v-img>
                                <v-card-title>
                                    <v-row>
                                        <v-col cols="9" sm="6">
                                            Back Image
                                        </v-col>
                                        <v-col cols="12" sm="4">
                                            <v-file-input
                                                @input="form.backImg = $event.target.files[0]"
                                                @change="prev_backImg"
                                                v-model="form.backImg"
                                                label="Update Front Image"
                                                filled
                                                prepend-icon="mdi-camera"
                                            ></v-file-input>
                                        </v-col>
                                        <v-col>
                                            <v-img :src="backImg" max-height="200px" max-width="100px"></v-img>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <div class="m-4">
                                    <v-row>
                                        <v-col cols="12"
                                               sm="6">
                                            <v-text-field
                                                v-model="form.chequeNo"
                                                type="number"
                                                :error-messages="chequeNumberErrors"
                                                label="Enter Cheque Number"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12"
                                               sm="6">
                                            <input type="date" v-model="form.chequeDate">
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                            <v-text-field
                                                v-model="form.agent_id"
                                                type="number"
                                                :error-messages="pchequeNumberErrors"
                                                label="Agent Id"
                                                readonly
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                            <v-text-field
                                                v-model="form.payment_id"
                                                type="number"
                                                :error-messages="chequeNumberErrors"
                                                label="Enter Payment ID"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                            <v-text-field
                                                v-model="form.created_at"
                                                :error-messages="pchequeNumberErrors"
                                                label="Submit Date"
                                                readonly
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                        >
                                            <v-text-field
                                                v-model="form.updated_at"
                                                :error-messages="pchequeNumberErrors"
                                                label="Last Update"
                                                readonly
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-textarea
                                        v-model="form.agent_Note"
                                        filled
                                        label="Agent Note"
                                        auto-grow
                                        readonly
                                        value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                    ></v-textarea>
                                    <v-textarea
                                        v-model="form.admin_Note"
                                        filled
                                        label="Agent Note"
                                        auto-grow
                                        counter="255"
                                        required
                                        value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                    ></v-textarea>
                                    <input type="text" v-model="form.admin_id" hidden>
                                </div>
                                <v-btn
                                    class="mr-4"
                                    type="submit"
                                    color="primary"
                                    dark
                                >
                                    Update
                                </v-btn>
                                <v-btn type="button" class="mr-4" color="green" dark @click="accept">Accept</v-btn>
                                <v-btn type="button" class="mr-4" color="error" dark @click="reject">Reject</v-btn>
                                <v-btn type="button" class="mr-4" color="amber" dark @click="dlt">Delete</v-btn>
                            </form>

                        </v-card>

                    </div>
                </div>

            </div>
        </v-app>
    </Layout>
</template>

<script>
import Layout from "../../../Shared/Admin/Layout";

export default {
    components: {
        Layout,
    },
    data() {
        return {
            form: {
                id: this.cheque.id,
                chequeNo: this.cheque.chequeNo,
                payment_id: this.cheque.payment_id,
                chequeDate: this.cheque.chequeDate,
                remark: this.cheque.remark,
                agent_id: this.cheque.agent_id,
                agent_Note: this.cheque.agent_Note,
                frontImg: null,
                backImg: null,
                created_at: this.cheque.created_at,
                updated_at: this.cheque.updated_at,
                admin_Note: this.cheque.admin_Note,
                admin_id: null
            }
        }
    },
    props: [
        'cheque',
        'errors',
        'successMessage'
    ],
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
        dlt: function () {
            this.$inertia.post('/delete', this.form)
        },
        prev_frontImg() {
            this.frontImg = URL.createObjectURL(this.form.frontImg)
        },
        prev_backImg() {
            this.backImg = URL.createObjectURL(this.form.backImg)
        }
    }
}
</script>

<style scoped>

</style>
