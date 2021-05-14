<template>
    <Layout>
        <v-app>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-warning card-header-icon">

                        <div class="card-icon">

                            <i class="material-icons">request_quote</i>
                        </div>
                        <h4 class="card-title">Pending Cheques</h4>
                        <v-card class="mt-3 mb-3">
                            <v-alert
                                dense
                                text
                                type="success"
                                v-if="successMessage"
                            >
                                {{successMessage}}
                            </v-alert>
                            <v-card-title>
                                <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>

                            </v-card-title>
                            <v-data-table
                                :headers="headers"
                                :items="cheques"
                                :search="search"
                                class="table-striped table-no-bordered table-hover dataTable"
                            >
                                <template v-slot:item="cheque">
                                    <!--display data-->
                                    <tr>

                                        <td>{{ cheque.item.chequeNo }}</td>
                                        <td>{{ cheque.item.payment_id }}</td>
                                        <td>{{ cheque.item.agent_id }}</td>
                                        <td>{{ cheque.item.chequeDate }}</td>
                                        <td>{{ cheque.item.created_at }}</td>
                                        <td><img class="thubnailImg" v-bind:src="cheque.item.frontImg"></td>
                                        <td><img class="thubnailImg" v-bind:src="cheque.item.backImg"></td>
                                        <td>{{ cheque.item.agent_Note }}</td>
                                        <td>
                                            <v-btn color="primary" dark @click="display(cheque.item)">
                                                <v-icon dark>visibility</v-icon>
                                            </v-btn>
                                            <v-btn color="success" dark @click="accept(cheque.item)">
                                                <v-icon dark>task_alt</v-icon>
                                            </v-btn>
                                            <v-btn color="error" dark @click="reject(cheque.item)">
                                                <v-icon dark>close</v-icon>
                                            </v-btn>
                                        </td>

                                    </tr><!-- end of display data-->
                                </template>
                            </v-data-table>
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
    props: ['cheques','successMessage'],
    data() {
        return {
            search: '',
            expanded: [],
            singleExpand: false,
            headers: [
                {
                    text: 'Cheque Number',
                    align: 'start',
                    sortable: false,
                    value: 'chequeNo'
                },
                {text: 'Payment Id', value: 'payment_id'},
                {text: 'Agent Id', value: 'agent_id'},
                {text: 'Cheque Date', value: 'chequeDate'},
                {text: 'Submit Date', value: 'created_at'},
                {text: 'Front Image', value: 'frontImg'},
                {text: 'Back Image', value: 'backImg'},
                {text: 'Agent Note', value: 'agent_Note'},
            ],

        }
    },
    methods: {
        accept: function (data) {
            this.$inertia.put('/Cheque/approve/' + data.id)
        },
        reject: function (data) {
            this.$inertia.put('/Cheque/reject/' + data.id)
        },
        display: function (data) {
            this.$inertia.get('/Cheque/' + data.id)
        }
    },

}
</script>
<style scoped>
.thubnailImg {
    width: 200px;
    height: 100px;
}
</style>
