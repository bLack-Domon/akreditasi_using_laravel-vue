<script setup>
import NavLink from '@/Components/NavLink.vue';

import { usePage } from "@inertiajs/vue3";

import { computed } from "vue";

const page = usePage();
const nama_user = computed(() => page.props.auth.user.user);
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
      <NavLink :href="route('adminDashboard')" class="nav-link" :active="route().current('adminDashboard')">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Beranda
        </p>
      </NavLink>
     </li>
     <li class="nav-item">
       <a href="#" class="nav-link" data-toggle="collapse" data-target="#FirstMenu" aria-expanded="false" aria-controls="FirstMenu">
         <i class="nav-icon fas fa-server"></i>
         <p>
           Data Master
         </p>
       </a>
     </li>
     <div class="collapse" id="FirstMenu">
         <li class="nav-item">
          <NavLink :href="route('data-lembaga-akreditasi.index')" class="nav-link" :active="route().current('data-lembaga-akreditasi.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Lembaga Akreditasi
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('data-lembaga-unuja.index')" class="nav-link" :active="route().current('data-lembaga-unuja.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Lembaga Unuja
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('data-jenis-bab.index')" class="nav-link" :active="route().current('data-jenis-bab.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Jenis BAB
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('data-jenis-sub-bab.index')" class="nav-link" :active="route().current('data-jenis-sub-bab.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Jenis Detail BAB
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('data-jenis-kriteria.index')" class="nav-link" :active="route().current('data-jenis-kriteria.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Jenis Kriteria
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('data-jenis-sub-kriteria.index')" class="nav-link" :active="route().current('data-jenis-sub-kriteria.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Jenis Sub Kriteria
            </p>
          </NavLink>
         </li>
         
     </div>
     <li class="nav-item">
       <a href="#" class="nav-link" data-toggle="collapse" data-target="#SecondMenu" aria-expanded="false" aria-controls="SecondMenu">
         <i class="nav-icon fas fa-edit"></i>
         <p>
           Data Monitoring
         </p>
       </a>
     </li>
     <div class="collapse" id="SecondMenu">
         <li class="nav-item">
          <NavLink :href="route('monitoring-lkps.index')" class="nav-link" :active="route().current('monitoring-lkps.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Monitoring LKPS
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('monitoring-led.index')" class="nav-link" :active="route().current('monitoring-led.*')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Monitoring LED
            </p>
          </NavLink>
         </li>
         <li class="nav-item">
          <NavLink :href="route('daftarDokumen')" class="nav-link" :active="route().current('daftarDokumen')">
            <i class="ml-1 fas fa-ellipsis-v nav-icon"></i>
            <p>
              Data Dokumen Akreditasi
            </p>
          </NavLink>
         </li>
     </div>
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