<template>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">request_quote</i>
                    </div>
                    <h4 class="card-title">Deleted Cheques</h4>
                    <v-card class="mt-3 mb-3">
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
                                    <td>{{ cheque.item.admin_id }}</td>
                                    <td>{{ cheque.item.created_Date}}</td>
                                    <td>{{ cheque.item.created_at }}</td>
                                    <td><img class="thubnailImg" v-bind:src="cheque.item.frontImg"></td>
                                    <td><img class="thubnailImg" v-bind:src="cheque.item.backImg"></td>
                                    <td>{{ cheque.item.agent_Note }}</td>
                                    <td>{{ cheque.item.admin_Note }}</td>
                                </tr><!-- end of display data-->
                            </template>
                        </v-data-table>
                    </v-card>

                </div>
            </div>
        </div>

</template>

<script>
import Layout from "../../../Shared/Admin/Layout";

export default {
    components: {
        Layout,
    },
    props: ['cheques'],
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
                {text: 'Admin Id', value: 'admin_id'},
                {text: 'submit Date', value: 'created_Date'},
                {text: 'Deleted Date', value: 'created_at'},
                {text: 'Front Image', value: 'frontImg'},
                {text: 'Back Image', value: 'backImg'},
                {text: 'Agent Note', value: 'agent_Note'},
                {text: 'Admin Note', value: 'admin_Note'},
            ],

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
