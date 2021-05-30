<template>
    <Layout>
        <v-app>
            <div>
                <h2> View Complaint</h2>
                <div class="container">

                        <form @submit.prevent="update(complaint)" >
                        <v-container>
                            <v-container>
                                <v-row>
                                    <v-col cols="6" md="3">
                                      <v-text-field
                                        outlined
                                        v-model="complaint.complaintId"
                                        label="Complaint Id"
                                        readonly
                                      ></v-text-field>
                                    </v-col>

                                    <!-- enter the user ID -->
                                    <v-col cols="6" md="3">
                                      <v-text-field
                                        outlined
                                        v-model="complaint.user_id"
                                        label="userID"
                                        readonly
                                      ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>

                            <!--select the category -->
                            <v-col cols="6">
                                <v-text-field
                                    outlined
                                    v-model="complaint.category"
                                    label="Category"
                                    readonly
                                ></v-text-field>
                            </v-col>

                            <!--message text field  -->
                            <v-col cols="6">
                                <v-textarea
                                    outlined
                                    v-model="complaint.message"
                                    label="Message"
                                    readonly

                                ></v-textarea>
                            </v-col>

                            <v-card-title>Update the status</v-card-title>
                            <v-divider class="mx-4"></v-divider>

                            <!--status select  -->
                            <v-card-text>
                                <v-col cols="6">
                                <v-select
                                    v-model="complaint.status"
                                    :items="itm"
                                    label="Select"

                                >
                                </v-select>
                                </v-col>
                            </v-card-text>

                            <v-divider class="mx-4"></v-divider>

                           <button button type="submit" class="btn btn-behance mb-3">Update</button>
                        </v-container>

                        </form>


                </div>



            </div>
        </v-app>
    </Layout>
</template>

<script>

import Layout from '../../../Shared/Admin/Layout.vue'

export default {

    components:{
        Layout,

    },
    props:['complaint'],

    data: function () {


        return {
            complaint: {
                complaintId: 'complaint.complaintId',
                user_id: 'complaint.user_id',
                category: 'complaint.category',
                message: 'complaint.message',
                status: 'complaint.status',
            },

            //select items in the status list
            itm:[
                'important',
                'read',
            ],
        }
    },

    methods:{
        update:function(complaint){
            this.$inertia.post('/updateComplaint',complaint);
        }


    }

}
</script>
