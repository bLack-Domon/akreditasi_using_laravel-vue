<template>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <TopBar/>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#2c3d55;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <BrandLogo/>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="brand-link">
        <ProfilUser/>
      </div>


      <!-- Sidebar Menu -->
      <SidebarMenu/>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <slot/>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <FooterBar/>
</div>
<!-- wrapper -->
</template>

<script>
import TopBar from "@/Layouts/frames/TopBar.vue";
import BrandLogo from "@/Layouts/frames/BrandLogo.vue";
import ProfilUser from "@/Layouts/frames/ProfilUser.vue";
import SidebarMenu from "@/Layouts/frames/SidebarMenu.vue";
import FooterBar from "@/Layouts/frames/FooterBar.vue";
export default {
  components: {
    TopBar,
    BrandLogo,
    ProfilUser,
    SidebarMenu,
    FooterBar,
  },
}
</script>