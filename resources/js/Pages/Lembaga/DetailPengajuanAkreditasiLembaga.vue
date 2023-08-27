<script setup>
import LembagaLayout from "@/Layouts/LembagaLayout.vue";
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
  detail_pengajuan: Object,
});
</script>

<template>
  <Head title="Detail Monitoring LED" />

  <LembagaLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <!-- table -->
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i
                class="fas fa-cubes"
                style="margin-left: -10px; margin-rigth: 5px"
              ></i>
              Detail Pengajuan Akreditasi Prodi
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
                  <th style="text-align: center; vertical-align: middle">
                    Nama Lembaga
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    BAB
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Sub BAB
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Kriteria
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Proses
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Tanggal Pengisian
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in detail_pengajuan" :key="d">
                  <td style="text-align: center; vertical-align: middle">
                    {{ x + 1 }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.nama_lembaga }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    {{ d.nama_bab }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    {{ d.nama_sub_bab }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    {{ d.nama_kriteria }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    {{ d.Percentage }}%
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    {{ dateFormat(d.tgl_pengisian) }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <Link
                      class="btn btn-sm btn-success"
                      :href="`/cek-dokumen-akreditasi/NBrm00f7EJFeQ${d.id_detail_pengajuan}dwcScY3DLl81Z`"
                      ><i class="fas fa-file"></i> Cek Dokumen
                    </Link>
                  </td>
                </tr>
              </tbody>
            </DataTable>
          </div>
        </div>
      </section>
    </div>
  </LembagaLayout>
</template>
