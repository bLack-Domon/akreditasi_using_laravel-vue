<script setup>
import KaprodiLayout from '@/Layouts/KaprodiLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import moment from "moment";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data: Object
});

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}
</script>

<template>
    <Head title="Pengajuan Akreditasi" />

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
                  Pengajuan Akreditasi - {{ $page.props.auth.user.nama_lembaga }}
                </h3>
              </div>
              <div class="card-body">
                <!-- table -->
                <DataTable class="display table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center; vertical-align: middle">
                        No
                      </th>
                      <th style="text-align: center; vertical-align: middle">
                        Nama Lembaga Unuja
                      </th>
                      <th style="text-align: center; vertical-align: middle">
                        Tanggal Pengajuan
                      </th>
                      <th style="text-align: center; vertical-align: middle">
                        Nama Lembaga Akreditasi
                      </th>
                      <th style="text-align: center; vertical-align: middle">
                        Detail
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(d, index) in data" :key="d">
                      <td style="text-align: center; vertical-align: middle">
                        {{ index + 1 }}
                      </td>
                      <td style="vertical-align: middle">
                        {{ d.lembaga_unuja.nama_lembaga }}
                      </td>
                      <td style="text-align: center; vertical-align: middle">
                        {{ dateFormat(d.tgl_pengajuan) }}
                      </td>
                      <td style="text-align: center; vertical-align: middle">
                        {{ d.lembaga_akreditasi.nama_lembaga }}
                      </td>
                      <td style="text-align: center; vertical-align: middle">
                        <Link
                          :href="`/pengajuan-akreditasi/2e2f9g0${d.id_pengajuan}u4l32ccd/prodi-detail`"
                          class="btn btn-sm btn-success mr-1"
                          >Sebaran
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
