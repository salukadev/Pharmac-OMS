
<template>
    <v-app>
<!-- SUPPLIER DETAILS EDIT FORM -->
<div style="text-align: right; padding: 20px">
<v-row class="d-flex justify-end mb-6">
    <v-dialog
        v-model="form_ed"
        persistent
        max-width="500px"
    >
        <template v-slot:activator="{ on, attrsE }">
            <v-btn
                color="indigo darken-4"
                icon
                v-bind="attrsE"
                v-on="on"
            >
                <v-icon>mdi-pencil</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Update Details</span>
            </v-card-title>
            <v-card-text>
                <v-container >

                    <v-form
                        ref="editform"
                        v-model="valid_ed"
                        lazy-validation
                    >
                        <v-text-field
                            label="E-mail"
                            v-model="editform.email"
                            :rules="emailRules"
                            required
                        ></v-text-field>
                        <v-text-field
                            label="Address "
                            v-model="editform.address"
                            :counter="255"
                            :rules="addressRules"
                            required
                        ></v-text-field>
                        <v-text-field
                            label="Telephone No"
                            v-model="editform.telephone"
                            :counter="10"
                            :rules="telephoneRules"
                            required
                        ></v-text-field>


                        <v-btn
                            color="error"
                            class="mr-4"
                            @click="resetEd"
                        >
                            Close
                        </v-btn>
                        <v-btn
                            color="error"
                            class="mr-4"
                            @click="submitEd"
                        >
                            Update
                        </v-btn>


                    </v-form>
                </v-container>
            </v-card-text>

        </v-card>
    </v-dialog>
</v-row>

</div>
    </v-app>
</template>
<!-- EDIT FORM ENDS HERE -->
<script>




export default {
    name: "SupplierEdit.vue",

    components:{

    },
    props:{
        suppliers:Array,
        supplier: Object,
    },


    data(){
        return {
            valid:true,
            valid_ed:true,

            form: false,
            form_ed:false,



            editform:{
                email:'',
                address:'',
                telephone:'',
            },

            emailRules: [
                v => !!v || 'E-mail is required',
            ],

            addressRules: [
                v => !!v || 'Address is required',
                v => (v && v.length <= 255) || 'Address must be less than 255 characters',
            ],

            telephoneRules: [
                v => !!v || 'Telephone is required',
                v => (v && v.length <= 10) || 'Telephone no must be less than 255 characters',
            ],

        }
    },


    methods:{

        //validations for edit function
        validateEd () {
            this.$refs.editform.validate()
        },
        resetEd () {
            this.form_ed = false
            this.$refs.editform.reset()
        },
        submitEd(){
            console.log(this.editform.email)
            this.$inertia.post('/supplier/update', data)
            //this.$inertia.post('/supplier/store',this.editform);
            //this.$refs.editform.reset()
            this.form_ed = false
        }
    }
}
</script>

