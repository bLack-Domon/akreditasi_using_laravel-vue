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
  data: Object,
  lkps: Object
})
</script>

<template>
  <Head title="Dokumen Akreditasi & LKPS" />

  <KaprodiLayout>
    <!-- table -->
    <div class="row justify-content-center">
      <div class="col-lg-12 mt-3 connectedSortable">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
              Data Dokumen Akreditasi <small class="text-dark">(Silahkan klik tombol show dokumen untuk melihat contoh dokumen yang
                dibutuhkan.)</small>
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
                  <th style="vertical-align: middle">
                    Nama Lembaga
                  </th>
                  <th style="vertical-align: middle">
                    Nama Dokumen
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Cek Dokumen
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in data" :key="d">
                  <td style="text-align: center; vertical-align: middle">
                    {{ x + 1 }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.create_by }}
                  </td>
                  <td style="vertical-align: middle">{{ d.nama_dokumen }}</td>
                  <td style="text-align: center; vertical-align: middle">
                    <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-success"><i
                        class="fas fa-eye"></i> Show Dokumen</a>
                  </td>
                </tr>
              </tbody>
            </DataTable>
          </div>
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
              Data Dokumen LKPS <small class="text-dark">(Silahkan klik tombol show dokumen untuk melihat contoh dokumen yang
                dibutuhkan.)</small>
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
                  <th style="vertical-align: middle">
                    Nama Lembaga
                  </th>
                  <th style="vertical-align: middle">
                    Nama Dokumen
                  </th>
                  <th style="text-align: center; vertical-align: middle">
                    Cek Dokumen
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in lkps" :key="d">
                  <td style="text-align: center; vertical-align: middle">
                    {{ x + 1 }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.create_by }}
                  </td>
                  <td style="vertical-align: middle">{{ d.nama_dokumen }}</td>
                  <td style="text-align: center; vertical-align: middle">
                    <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-success"><i
                        class="fas fa-eye"></i> Show Dokumen</a>
                  </td>
                </tr>
              </tbody>
            </DataTable>
          </div>
        </div>
      </div>
    </div>
  </KaprodiLayout>
</template>
