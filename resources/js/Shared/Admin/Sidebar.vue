<template>
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-mini">
            PD
        </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                Pharmac LTD
            </a></div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="img/faces/avatar.jpg" />
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                Tania Andrew
                <b class="caret"></b>
              </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> MP </span>
                                    <span class="sidebar-normal"> My Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> EP </span>
                                    <span class="sidebar-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> S </span>
                                    <span class="sidebar-normal"> Settings </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/orders">

                        <i class="material-icons">local_shipping</i>
                        <p> Orders </p>
                    </inertia-link>
                </li>
                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/supplier">

                        <i class="material-icons">local_shipping</i>
                        <p> Suppliers </p>
                    </inertia-link>
                </li>
                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/returns">

                        <i class="material-icons">local_shipping</i>
                        <p> Return </p>
                    </inertia-link>
                </li>


            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>

</style>
