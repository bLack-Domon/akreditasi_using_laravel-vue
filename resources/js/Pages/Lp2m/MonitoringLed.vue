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
  data_pengajuan: Object,
});
</script>

<template>
  <Head title="Monitoring LED" />

  <AdminLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div
          v-if="$page.props.flash.message"
          class="alert alert-success alert-dismissible fade show"
          role="alert"
        >
          {{ $page.props.flash.message }}
          <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- table -->
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i
                class="fas fa-cubes"
                style="margin-left: -10px; margin-rigth: 5px"
              ></i>
              Monitoring LED
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
            <DataTable class="display table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="text-align: center; vertical-align: middle">No</th>
                  <th style="vertical-align: middle">Nama Prodi</th>
                  <th style="text-align: center; vertical-align: middle">Tanggal Pengajuan</th>
                  <th style="vertical-align: middle">Penanggung Jawab</th>
                  <th style="text-align: center; vertical-align: middle">Nilai</th>
                  <th style="text-align: center; vertical-align: middle">Aksi</th>
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
                  <td style="text-align: center; vertical-align: middle">
                    {{ dateFormat(d.tgl_pengajuan) }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.lembaga_akreditasi.nama_lembaga }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <span v-if="d.nilai == NULL " class="text-danger">Belum di Nilai</span>
                    <span v-else>{{ d.nilai }}</span>
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <Link
                      class="btn btn-sm btn-success mr-1"
                      :href="`/detail-monitoring-led/XGuHRseFbdpoxBonv5${d.id_pengajuan}89lMFbNGUBTntTl`"
                    >
                      Detail
                    </Link>
                    <Link
                      class="btn btn-sm btn-warning mr-1"
                      :href="`/nilai-monitoring-led/khygvbnTd45${d.id_pengajuan}PHgfrtCE4qw`"
                    >
                      Beri Nilai
                    </Link>
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
