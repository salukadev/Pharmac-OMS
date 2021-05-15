<template>
    <Layout>
        <v-app id="inspire">
        <div>
            <h3 align="center">Welcome TO Pharmac OMS</h3>
            <v-card class="mt-5 mb-8">
                <v-card-text>
                    <v-container pa-0>
                        <v-row dense>
                            <v-col cols="12">
                                <v-card
                                    class="pa-2"

                                    tile
                                >
                                    <div>

                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Registration Requests
                                                    </p>
                                                    <p>NEW REGISTRATIONS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                </v-card-actions>

                                            </v-card>
                                    </div>
                                </v-card>
                            </v-col>

                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>

                                        <v-card
                                            max-width="auto"
                                        >
                                            <v-card-text>

                                                <p class="display-1 text--primary">
                                                   Product Requests
                                                </p>
                                                <p>NEW PHARMACEUTICAL REQUESTS</p>
                                            </v-card-text>
                                            <v-card-actions class="pt-0">
                                                <v-btn
                                                    text
                                                    color="teal accent-4"
                                                    @click=""
                                                >
                                                    Expand
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>
                                            <v-card
                                                max-width="auto"
                                            >
                                                <v-card-text>

                                                    <p class="display-1 text--primary">
                                                        Agents
                                                    </p>
                                                    <p>ALL AGENTS DETAILS</p>
                                                </v-card-text>
                                                <v-card-actions class="pt-0">
                                                    <v-btn
                                                        text
                                                        color="teal accent-4"
                                                        @click=""
                                                    >
                                                        Expand
                                                    </v-btn>
                                                </v-card-actions>

                                            </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>

                                        <v-card
                                            max-width="auto"
                                        >
                                            <v-card-text>

                                                <p class="display-1 text--primary">
                                                    Customers
                                                </p>
                                                <p>ALL REGISTERED CUSTOMERS</p>
                                            </v-card-text>
                                            <v-card-actions class="pt-0">
                                                <v-btn
                                                    text
                                                    color="teal accent-4"
                                                    @click=""
                                                >
                                                    Expand
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                        </v-row>
<!--third Row-->
                        <v-row>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>

                                        <v-card
                                            max-width="auto"
                                        >
                                            <v-card-text>

                                                <p class="display-1 text--primary">
                                                   Stock
                                                </p>
                                                <p>PHARMACEUTICAL PRODUCT STOCKS</p>
                                            </v-card-text>
                                            <v-card-actions class="pt-0">
                                                <v-btn
                                                    text
                                                    color="teal accent-4"
                                                    @click=""
                                                >
                                                    Expand
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>
                                        <v-card
                                            max-width="auto"
                                        >
                                            <v-card-text>

                                                <p class="display-1 text--primary">
                                                    Complaints
                                                </p>
                                                <p>CUSTOMER COMPLAINTS</p>
                                            </v-card-text>
                                            <v-card-actions class="pt-0">
                                                <v-btn
                                                    text
                                                    color="teal accent-4"
                                                    @click=""
                                                >
                                                    Expand
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                            <v-col cols="4">
                                <v-card
                                    class="pa-2"
                                    outlined
                                    tile
                                >
                                    <div>

                                        <v-card
                                            max-width="auto"
                                        >
                                            <v-card-text>

                                                <p class="display-1 text--primary">
                                                    Payments
                                                </p>
                                                <p>CHEQUES AND ONLINE PAYMENTS</p>
                                            </v-card-text>
                                            <v-card-actions class="pt-0">
                                                <v-btn
                                                    text
                                                    color="teal accent-4"
                                                    @click=""
                                                >
                                                    Expand
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </div>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </div>
        </v-app>

    </Layout>
</template>

<script>
import Layout from "../Shared/Admin/Layout";

export default {
    components:{
      Layout,
    },
    props:['version']
}
</script>
