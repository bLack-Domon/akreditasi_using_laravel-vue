<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Admin Dashboard" />

  <AdminLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i
                class="fas fa-cubes"
                style="margin-left: -10px; margin-rigth: 5px"
              ></i>
              Daftar Menu Aplikasi Akreditasi UNUJA
            </h3>
            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <h5 style="margin-left: 10px;">Penjelasan Menu-Menu Aplikasi Akreditasi UNUJA</h5>
            <ol>
              <li>Beranda</li>
              <p>Menjelaskan daftar menu serta fungsi yang ada pada aplikasi akreditasi UNUJA.</p>
              <li>Data Master</li>
              <p>Berfungsi sebagai pusat data master dimana terdapat sub menu yang terdiri dari Data Lembaga Akreditasi hingga Data Jenis Sub Kriteria.</p>
              <li>Data Monitoring</li>
              <p>Berfungsi untuk memonitoring pengajuan akreditasi dan pengajuan LKPS.</p>
            </ol>
          </div>
        </div>
      </section>
    </div>
  </AdminLayout>
</template>
