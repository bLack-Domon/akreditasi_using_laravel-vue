<script setup>
import KaprodiLayout from '@/Layouts/KaprodiLayout.vue';
import { Head } from '@inertiajs/vue3';

import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data_pengajuan: Object
})
</script>

<template>
  <Head title="Hasil Review Pengajuan Akreditasi" />

  <KaprodiLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
              Hasil Review Pengajuan Akreditasi Prodi - {{ $page.props.auth.user.nama_lembaga }}
            </h3>
          </div>

          <!-- table -->
          <div class="card-body">
            <DataTable class="display table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="text-align: center; vertical-align: middle">
                    No
                  </th>
                  <th style="vertical-align: middle">
                    Nama Lembaga
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Tanggal Pengajuan
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Tanggal Penilaian
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Nilai
                  </th>
                  <th style="vertical-align: middle">
                    Nama Lembaga Akreditasi
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in data_pengajuan" :key="d">
                  <td style="text-align: center; vertical-align: middle">
                    {{ x + 1 }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.create_by }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">{{ dateFormat(d.tgl_pengajuan) }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <span v-if="d.tgl_penilaian == NULL " class="text-danger">Belum di Nilai</span>
                    <span v-else>{{ dateFormat(d.tgl_penilaian) }}</span>
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <span v-if="d.nilai == NULL " class="text-danger">Belum di Nilai</span>
                    <span v-else>{{ d.nilai }}</span>
                  </td>
                  <td style="vertical-align: middle">
                    {{d.lembaga_akreditasi.nama_lembaga}}
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
