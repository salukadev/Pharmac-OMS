<template>
    <Layout>
        <v-app>
    <v-card class="mx-auto" max-width="auto" tile>
        <v-img height="200" src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"></v-img>
        <v-row style="margin:2.5%;position:absolute; top: 130px">

            <v-list-item>
                <v-list-item-avatar size="100">
                    <img
                        src="https://www.w3schools.com/howto/img_avatar.png"
                        alt="Image"
                    >
                </v-list-item-avatar>
                <v-list-item-content style="margin:20px;">
                    <v-list-item-title class="title" >Danuja Wijerathna</v-list-item-title>
                    <v-list-item-subtitle>Buyer</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-row>
        <v-row>
            <v-simple-table style="margin-left:20px; margin-top:80px;">
                <template v-slot:default>
                    <tbody >
                    <tr
                        v-for="item in desserts"
                        :key="item.name"
                    >
                        <td>{{ item.name }}</td>
                        <td>{{ item.data }}</td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-row>



        <v-row >
            <v-col>
            <v-btn color="blue" @click=""
                   style="margin-left:20px;margin-bottom: 40px" >
                Edit profile
            </v-btn>
            </v-col>

            <v-col>
                <v-dialog
                    v-model="form"
                    persistent
                    max-width="600px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="blue"
                            v-bind="attrs"
                            v-on="on"
                        >
                            Add Product Request
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Add Product Request</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-form
                                    ref="addProductRequest"
                                    v-model="valid"
                                    lazy-validation
                                >

                                    <v-row>
                                        <v-col
                                            cols="12"
                                        >
                                            <v-text-field
                                                v-model="addProductRequest.user_id"
                                                :counter="3"
                                                :rules="user_idRules"
                                                label="User ID"
                                                required
                                            ></v-text-field>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.generic"
                                                :counter="100"
                                                :rules="genericRules"
                                                label="Generic"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.brand"
                                                :counter="100"
                                                :rules="brandRules"
                                                label="Brand"
                                                type="text"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.description"
                                                :counter="100"
                                                label="Description"
                                                type="text"
                                            ></v-text-field>
                                        </v-col>

                                    </v-row>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="error"
                                class="mr-4"
                                @click="reset"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                color="success"
                                class="mr-4"
                                @click="submit"
                            >
                                Add
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>

            <v-col>
                <v-btn color="blue"  @click=""
                       style="margin-left:20px;margin-bottom: 40px" >
                    Edit profile
                </v-btn>
            </v-col>
        </v-row>
    </v-card>
        </v-app>
    </Layout>

</template>

<script>
import Layout from '../Shared/Admin/Layout'
export default {
    name: "UserProfile",
    components:{
        Layout,
    },
    data () {
        return {
            valid:true,
            form: false,
            addProductRequest:{
                user_id:'',
                generic:'',
                brand:'',
                description:'',
            },

            user_idRules: [
                v => !!v || 'User id is required',
            ],

            genericRules: [
                v => !!v || 'Generic is required',
                v => (v && v.length <= 100) || 'Generic must be less than 100 characters',
            ],
            brandRules: [
                v => !!v || 'Brand is required',
                v => (v && v.length <= 100) || 'Brand must be less than 100 characters',
            ],

            desserts: [
                {
                    name: 'Username',
                    data: 'Danuja',
                },
                {
                    name: 'Telephone',
                    data: '0714562874',
                },
                {
                    name: 'Email',
                    data: 'danuja@yahoo.com',
                },

            ],
        }

    },
    methods:{
        validate () {
            this.$refs.addProductRequest.validate()
        },
        reset () {
            this.form = false
            this.$refs.addProductRequest.reset()
        },
        submit() {
            this.$swal({
                title: "Done",
                text: "Request Sent Successfully",
                icon: "success",
                buttons: true,
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                dangerMode: false,
            });

            this.$inertia.post('/productRequest/storeRequest', this.addProductRequest)
            this.$refs.addProductRequest.reset()
            this.form = false


        },
    }
}
</script>

<style scoped>

</style>
