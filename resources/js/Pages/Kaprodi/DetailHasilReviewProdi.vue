<script setup>
import KaprodiLayout from '@/Layouts/KaprodiLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

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
    <Head title="Review Pengajuan Akreditasi" />

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
                  Hasil Review Pengajuan Akreditasi Prodi - {{ $page.props.auth.user.nama_lembaga }}
                </h3>
              </div>
              
          <!-- table -->
          <div class="row justify-content-center">
            <div class="col-lg-12 p-4">
              <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
                    Data Pengajuan Akreditasi <small>(Silahkan klik tombol cek untuk hasil review pengajuan anda.)</small>
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="text-align: center; vertical-align: middle">
                          No
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Lembaga
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Tanggal Pengajuan
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Cek Review
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in data_pengajuan" :key="d">
                        <td style="text-align: center; vertical-align: middle">
                          {{ x + 1 }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.lembaga_unuja.nama_lembaga }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">{{ dateFormat(d.tgl_pengajuan) }}</td>
                        <td style="text-align: center; vertical-align: middle">
                          <Link :href="`/hasil-review/${d.id_pengajuan}/pengajuan-akreditasi-prodi`" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Cek Review</Link>
                        </td>
                      </tr>
                    </tbody>
                  </DataTable>
                </div>
              </div>
            </div>
          </div>
            </div>
          </section>
        </div>
    </KaprodiLayout>
</template>
