<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>


<template>
 <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
     <li class="nav-header" style="margin-left: -10px">
       <u
         ><b
           ><span style="font-size: 20px">SILAHKAN PILIH MENU</span></b
         ></u
       >
     </li>
     <li class="nav-item">
      <NavLink :href="route('kaprodiDashboard')" class="nav-link" :active="route().current('kaprodiDashboard')">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="route('pengajuan-akreditasi-prodi.index')" class="nav-link" :active="route().current('pengajuan-akreditasi-prodi.*')">
        <i class="nav-icon fas fa-th-list"></i>
        <p>
          Pengajuan Akreditasi
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="route('sebaran-pengajuan-prodi.index')" class="nav-link" :active="route().current('sebaran-pengajuan-prodi.index')">
        <i class="nav-icon fas fa-share-alt"></i>
        <p>
          Sebaran Pengajuan
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="`/hasil-review-prodi`" class="nav-link" :active="route().current('hasil-review-prodi.*')">
        <i class="nav-icon fas fa-paste"></i>
        <p>
          Hasil Review
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="`/upload-lkps-prodi`" class="nav-link" :active="route().current('upload-lkps-prodi.*')">
        <i class="nav-icon fas fa-upload"></i>
        <p>
          Upload LKPS
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="route('dokAkreditasiLKPS.index')" class="nav-link" :active="route().current('dokAkreditasiLKPS.index')">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
          Dok Akreditasi & LKPS
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="route('logout')" class="nav-link btn no-background-btn" method="post" as="button">
        <span style="margin-left: -125px; color: #d0d6d1;"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</span>
      </NavLink>
     </li>
   </ul>
 </nav>
</template>


<style>
.no-background-btn {
    background-color: transparent;
    width: 235px;
}
</style>