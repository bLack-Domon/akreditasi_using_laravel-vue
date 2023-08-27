<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import LembagaLayout from "@/Layouts/LembagaLayout.vue";

import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.status_akun);

defineProps({
  id: Object
})
</script>

<template>
  <Head title="Data belum ada" />

  <AdminLayout v-if="user == 'admin'">
   <div class="row justify-content-center">
    <div class="col-md-8">
     <section class="content" style="margin-top: 50px;">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
  
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data belum ada.</h3>
  
          <p>
            Prodi tersebut belum melakukan upload file pengajuan akreditasi untuk dicek, Silahkan Kembali ke halaman sebelumnya untuk melihat pengajuan lainnya... 
            <Link :href="`/detail-monitoring-led/XGuHRseFbdpoxBonv5${id.id_pengajuan}89lMFbNGUBTntTl`">Klik di sini!!!</Link>
           </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    </div>
   </div>
  </AdminLayout>
  <LembagaLayout v-if="user == 'lembaga'">
   <div class="row justify-content-center">
    <div class="col-md-8">
     <section class="content" style="margin-top: 50px;">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
  
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data belum ada.</h3>
  
          <p>
            Prodi tersebut belum melakukan upload file pengajuan akreditasi untuk dicek, Silahkan Kembali ke halaman sebelumnya untuk melihat pengajuan lainnya... 
            <Link :href="`/detail-pengajuan-akreditasi/Njeu7O82cJqOcYv3oOu${id.id_pengajuan}CHrgPdzjEG3vn6Y`">Klik di sini!!!</Link>
           </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    </div>
   </div>
  </LembagaLayout>
</template>
