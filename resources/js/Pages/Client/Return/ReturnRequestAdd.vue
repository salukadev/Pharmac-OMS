<template>
    <Layout title="Returns">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Return Request</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div>
                                    <v-card class="d-flex  justify-center pa-2">
                                        <v-form
                                            ref="form"
                                            v-model="valid"
                                            lazy-validation
                                        >
                                            <br/><br/>
                                            <v-text-field
                                                v-model="form.order_id"
                                                :counter="10"
                                                :rules="[v => !!v || 'Order ID is required']"
                                                label="Order ID"
                                                required
                                            ></v-text-field>

                                            <v-text-field
                                                v-model="form.reason"
                                                :rules="[v => !!v || 'Reason is required']"
                                                label="Reason"
                                                required
                                            ></v-text-field>
                                            <v-text-field
                                                v-model="form.type"
                                                :rules="[v => !!v || 'Reason is required']"
                                                label="Type ( Refund | Reorder )"
                                                required
                                            ></v-text-field>

                                            <br/>
                                            &emsp;&emsp;&emsp;
                                            <v-btn
                                                color="error"
                                                class="mr-4"
                                                @click="reset"
                                            >
                                                Cancel
                                            </v-btn>
                                            &emsp;&emsp;&emsp;
                                            <v-btn
                                                color="blue"
                                                @click="submit"
                                            >
                                                Submit
                                            </v-btn>
                                            &emsp;&emsp;&emsp;
                                            <br/><br/><br/><br/>
                                        </v-form>
                                    </v-card>

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

export default {
    //name: "ReturnDetails",
    components:{
        Layout,
    },
    props:{
        product_returns:Array,
        product_return: Object,
    },
    data: () => ({
        valid: true,

        //form fields
        form:{
            order_id:'',
            reason:'',
            type:'',
        }

    }),

    methods: {
        reset () {
            this.$refs.form.reset()
        },
        submit () {
            //console.log(this.form.order_id, this.form.reason,this.form.type)

            this.$inertia.post('/return/store',this.form)
            this.$refs.form.reset()
        },
    },
}
</script>
