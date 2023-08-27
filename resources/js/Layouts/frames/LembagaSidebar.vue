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
      <NavLink :href="route('lembagaDashboard')" class="nav-link" :active="route().current('lembagaDashboard')">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
      <NavLink :href="`/daftar-prodi`" class="nav-link" :active="route().current('pengajuan-akreditasi-lembaga.*')">
        <i class="nav-icon fas fa-th-list"></i>
        <p class="wrap-text">
          Data Prodi
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