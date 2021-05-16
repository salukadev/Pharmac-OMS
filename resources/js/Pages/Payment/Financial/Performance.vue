<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-warning card-header-icon">

                <div class="card-icon">

                    <i class="material-icons">request_quote</i>
                </div>
                <h4 class="card-title">Agent Performance</h4>
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
                        :items="agentPerform"
                        :search="search"
                        class="table-striped table-no-bordered table-hover dataTable"
                    >
                        <template v-slot:item="agent">
                            <!--display data-->
                            <tr>
                                <td>{{ agent.item.agent_id }}</td>
                                <td>{{ agent.item.amount }}</td>
                                <td>
                                    <v-btn color="primary" dark @click="display(cheque.item)">
                                        View
                                    </v-btn>
                                    <v-btn color="success" dark @click="accept(cheque.item)">
                                        Remove
                                    </v-btn>
                                </td>

                            </tr><!-- end of display data-->
                        </template>
                    </v-data-table>
                </v-card>

            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-warning card-header-icon">

                <div class="card-icon">

                    <i class="material-icons">request_quote</i>
                </div>
                <h4 class="card-title">Customer Performance</h4>
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
                        :items="customerPerform"
                        :search="search"
                        class="table-striped table-no-bordered table-hover dataTable"
                    >
                        <template v-slot:item="cus">
                            <!--display data-->
                            <tr>
                                <td>{{ cus.item.id }}</td>
                                <td>{{ cus.item.amount }}</td>
                                <td>
                                    <v-btn color="primary" dark @click="display(cheque.item)">
                                        View
                                    </v-btn>
                                    <v-btn color="success" dark @click="accept(cheque.item)">
                                        Remove
                                    </v-btn>
                                </td>

                            </tr><!-- end of display data-->
                        </template>
                    </v-data-table>
                </v-card>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Performance",
    props:[
        'agentPerform',
        'customerPerform'
    ],
    data(){
        return {
            search: '',
            expanded: [],
            singleExpand: false,
            headers: [
                {
                    text: 'User Id',
                    align: 'start',
                    sortable: false,
                    value: 'id'
                },
                {text: 'Amount', value: 'amount'},
            ],

        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
