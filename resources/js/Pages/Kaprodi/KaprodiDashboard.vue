<script setup>
import KaprodiLayout from '@/Layouts/KaprodiLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Halaman Beranda" />

    <KaprodiLayout>
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
                <li>Dashboard</li>
                <p>Menjelaskan daftar menu serta fungsi yang ada pada aplikasi akreditasi UNUJA.</p>
                <li>Pengajuan Akreditasi</li>
                <p>Menu untuk melakukan pengajuan akreditasi, terdapat tombol sebaran yang berfungsi untuk melakukan entry detail pengajuan dengan tujuan mengelompokkan file / dokumen sesuai kriteria yang dipilih.</p>
                <li>Hasil Review</li>
                <p>Berfungsi untuk melihat hasil dari pengajuan akreditasi yang telah dilakukan.</p>
                <li>Upload LKPS</li>
                <p>Menu yang berfungsi untuk mengirimkan laporan kinerja program studi.</p>
                <li>Dok Akreditasi & LKPS</li>
                <p>Berfungsi sebagai menu untuk mengakses dokumen-dokumen yang telah diupload oleh prodi lain sebagai referensi bagi prodi lainnya.</p>
              </ol>
            </div>
          </div>
        </section>
      </div>
    </KaprodiLayout>
</template>
