<template>
 <Layout title="Agents">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">chat</i>
                                </div>
                                <h4 class="card-title">Messages</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

    <div class="container">

        <div class="chat-app">
       <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
        </div>

    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-app>
    </Layout>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    import Layout from '../../../Shared/Admin/Layout'
    export default {

        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            console.log("Mounted");
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },

        methods:{

            //Start converation
            startConversationWith(contact){

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },

            saveNewMessage(text){
                this.messages.push(text);
            }

        },






        components: {Conversation, ContactsList, Layout}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
