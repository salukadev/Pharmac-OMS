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
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">Chats</div>
                                            <div class="card-body">
                                            Chats
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="card">
                                            <div class="card-header">Users</div>
                                            <div class="card-body">
                                            Users
                                            </div>
                                        </div>
                                    </div>
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
import Layout from '../../../Shared/Admin/Layout'

export default {
    name: "AdminChat",
    components:{
        Layout,
    },
}
</script>
