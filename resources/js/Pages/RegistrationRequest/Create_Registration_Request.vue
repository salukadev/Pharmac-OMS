
<template>
    <v-app>
        <!-- making pop up window -->
    <v-dialog max-width="600px">
        <!-- make a button for popup-->
        <v-btn flat slot="activator" class="success">Add Request</v-btn>

        <v-card>
            <!-- make a title for popup-->
            <v-card-title>
                <h2>Add a New Request</h2>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-form
                        ref="addRequest"
                        v-model="valid"
                        lazy-validation
                    >

                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="addRequest.name"
                                    :counter="25"
                                    :rules="nameRules"
                                    label="Name"
                                    required
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12">
                                <v-text-field
                                    v-model="addRequest.address"
                                    :counter="20"
                                    :rules="addressRules"
                                    label="Address"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="addRequest.cusType"
                                    :counter="15"
                                    :rules="cusTypeRules"
                                    label="Customer Type"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="addRequest.telephone"
                                    :counter="10"
                                    :rules="telephoneRules"
                                    label="Telephone Number"
                                    type="text"
                                    required
                                ></v-text-field>
                            </v-col>



                        </v-row>

                        <v-btn  flat class ="success mx-0 mt-3" @click="submit">Add Request</v-btn>
                    </v-form>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>

</v-app>
</template>

<script>
export default {

    data() {
        return {
            addRequest: {
                name:'',
                address:'',
                cusType:'',
                telephone:'',
            },

            nameRules: [
                v => !!v || 'Name id is required',
            ],

            addressRules: [
                v => !!v || 'Address is required',
                v => (v && v.length <= 20) || 'Address must be less than 20 characters',
            ],

            cusTypeRules: [
                v => !!v || 'Customer Type is required',
                v => (v && v.length <= 15) || 'Customer Type must be less than 15 characters',
            ],

            telephoneRules: [
                v => !!v || 'Contact Number is required',
                v => (v && v.length <= 10) || 'Contact Number must be less than 10 characters',
            ],

        }
    },


    methods:{
        submit:function(){
            this.$inertia.post('/add',this.form);
        },
    }
}
</script>
