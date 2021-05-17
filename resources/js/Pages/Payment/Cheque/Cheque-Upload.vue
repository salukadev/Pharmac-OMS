<template>
    <Layout>
        <v-app>
            <div align="center">

                <div class="card elevation-0">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">upload</i>
                        </div>
                        <h4 align="left" class="card-title">Cheque Portal</h4>
                        <v-card class="mt-10 mb-10" max-width="95%">
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
                                >{{ error }}</v-alert>
                            </p>
                            <form class="p-5" @submit.prevent="submit">
                                <v-row>
                                    <v-col>
                                        <v-img :src="url1" max-width="400px" max-height="200px" contain></v-img>
                                    </v-col>
                                    <v-col>
                                        <v-img :src="url2" max-width="400px" max-height="200px" contain></v-img>
                                    </v-col>
                                </v-row>

                                <v-row>
                                    <v-col cols="12"
                                           sm="6">
                                        <v-file-input
                                            @input="form.frontImg = $event.target.files[0]"
                                            @change="Preview_image1"
                                            v-model="form.frontImg"
                                            label="Input Front Image"
                                            filled
                                            prepend-icon="mdi-camera"
                                        ></v-file-input>
                                    </v-col>
                                    <v-col cols="12"
                                           sm="6">
                                        <v-file-input
                                            @change="Preview_image2"
                                            @input="form.backImg = $event.target.files[0]"
                                            v-model="form.backImg"
                                            label="Input Back Image"
                                            filled
                                            prepend-icon="mdi-camera"
                                        ></v-file-input>
                                    </v-col>
                                </v-row>
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
                                    <v-col
                                        cols="12"
                                        sm="6"
                                    >
                                        <v-menu
                                            v-model="menu2"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="auto"
                                        >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-text-field
                                                    v-model="form.chequeDate"
                                                    label="Select Cheque Date"
                                                    prepend-icon="mdi-calendar"
                                                    readonly
                                                    v-bind="attrs"
                                                    v-on="on"
                                                ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                v-model="form.chequeDate"
                                                @input="menu2 = false"
                                            ></v-date-picker>
                                        </v-menu>
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
                                <v-textarea
                                    v-model="form.agent_Note"
                                    filled
                                    label="Agent Note"
                                    auto-grow
                                    counter="255"
                                    value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                ></v-textarea>

                                <v-btn
                                    class="mr-4"
                                    type="submit"
                                    color="green"
                                    dark
                                >
                                    submit
                                </v-btn>
                                <v-btn dark type="reset" color="red accent-2">
                                    clear

                                </v-btn>
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
    props: ['errors','currentUser','successMessage']
    ,
    data() {
        return {
            form: {
                chequeNo: null,
                payment_id: null,
                chequeDate: null,
                remark: null,
                agent_id: this.currentUser,
                agent_Note: null,
                frontImg: null,
                backImg: null,
            }
        }
    },
    methods: {
        submit: function () {
            this.loading = "True"
            this.$inertia.post('/Cheques/upload/store', this.form).then(() => {
                this.loading = "False"
            });
        },
        clear: function () {
            this.$reset()

        },
        Preview_image1() {
            this.url1 = URL.createObjectURL(this.form.frontImg)
        },
        Preview_image2() {
            this.url2 = URL.createObjectURL(this.form.backImg)
        }
    }

}
</script>
