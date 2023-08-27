<script setup>
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data: Object,
  pengajuan_akreditasi: Object,
});
</script>


<template>
  <Head title=" Detail Pengajuan Akreditasi" />

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
              Detail Pengajuan Akreditasi
            </h3>
          </div>
          <!-- table --> 
          <div class="card-body">
            <DataTable class="display table table-striped table-bordered">
              <thead>
                <tr>
                <th>No</th>
                <th>Pengajuan Akreditasi</th>
                <th>Sub Kriteria</th>
                <th>Sub Bab</th>
                <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in data" :key="d">
                  <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                  <td style="vertical-align: middle;">{{ pengajuan_akreditasi.lembaga_unuja.nama_lembaga }} - {{ pengajuan_akreditasi.lembaga_akreditasi.nama_lembaga }} </td>
                  <td style="vertical-align: middle;">{{ d.sub_kriteria.nama_sub_kriteria }}</td>
                  <td style="vertical-align: middle;">{{ d.sub_bab.nama_sub_bab }}</td>
                  <td style="text-align: center; vertical-align: middle;">
                    <Link
                      :href="`/detail-dokumen-akreditasi/3jy4h6n8m3${d.id_detail_pengajuan}p0c13x/prodi`"
                      class="btn btn-sm btn-success mr-1"
                      >Detail
                    </Link>
                  </td>
                </tr>
              </tbody>
            </DataTable>
          </div>
        </div>
      </section>
    </div>
  </KaprodiLayout>
</template>
