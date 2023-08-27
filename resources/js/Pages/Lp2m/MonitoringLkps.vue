<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  MonitoringLkps: Object, //menampilkan data
});
</script>

<template>
  <Head title="Monitoring LKPS" />

  <AdminLayout>
   <div class="row">
    <section class="col-lg-12 mt-3 connectedSortable">
      <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $page.props.flash.message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">
            <i
              class="fas fa-cubes"
              style="margin-left: -10px; margin-rigth: 5px"
            ></i>
            Monitoring LKPS
          </h3>
        </div>
        <div class="card-body">
          <DataTable class="display table table-striped table-bordered">
           <thead>
            <tr>
              <th style="text-align: center; vertical-align: middle">No</th>
              <th style="text-align: center; vertical-align: middle">Nama Prodi</th>
              <th style="text-align: center; vertical-align: middle">Tanggal Upload</th>
              <th style="text-align: center; vertical-align: middle">Tanggal Penilaian</th>
              <th style="text-align: center; vertical-align: middle">Lihat Dokumen</th>
              <th style="text-align: center; vertical-align: middle">Nilai LKPS</th>
              <th style="text-align: center; vertical-align: middle">Aksi</th>
            </tr>
          </thead>
          <tbody>
           <tr v-for="(d, x) in MonitoringLkps" :key="d">
            <td style="text-align: center; vertical-align: middle">{{ x + 1}}</td>
            <td style="text-align: center; vertical-align: middle">{{ d.lembaga_unuja.nama_lembaga }}</td>
            <td style="text-align: center; vertical-align: middle">{{ dateFormat(d.tgl_pengajuan) }}</td>
            <td style="text-align: center; vertical-align: middle">
              <span v-if="d.tgl_penilaian == NULL " class="text-danger">Belum di Nilai</span>
              <span v-else>{{ dateFormat(d.tgl_penilaian) }}</span>
            </td>
            <td style="text-align: center; vertical-align: middle">
              <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i
                  class="fas fa-eye"></i> Show Dokumen</a>
            </td>
            <td style="text-align: center; vertical-align: middle">
              <span v-if="d.nilai_lkps == NULL " class="text-danger">Belum di Nilai</span>
              <span v-else>{{ d.nilai_lkps }}</span>
            </td>
            <td>
              <Link :href="`/nilai-monitoring-lkps/kC7mbZLMEia93OVf${d.id_pengajuan_lkps}BZTmh8.TCyUd`" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Beri Nilai</Link>
            </td>
           </tr>
          </tbody>
          </DataTable>
        </div>
      </div>
    </section>
  </div>
  </AdminLayout>
</template>
