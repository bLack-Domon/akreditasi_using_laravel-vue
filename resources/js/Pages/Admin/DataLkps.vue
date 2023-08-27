<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data: Object
})
</script>

<template>
  <Head title="Data LKPS" />

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
            Data LKPS
          </h3>
        </div>

        <!-- table -->
        <div class="row justify-content-center">
          <div class="col-lg-12 p-4">
            <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">
                  <i
                    class="fas fa-cubes"
                    style="margin-left: -10px; margin-rigth: 5px"
                  ></i>
                  Detail Data LKPS
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
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Lembaga</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal Pengajuan</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal Penilaian</th>
                    <th style="text-align: center; vertical-align: middle;">Dokumen</th>
                    <th style="text-align: center; vertical-align: middle;">Nilai LKPS</th>
                    <th style="text-align: center; vertical-align: middle;">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(d, x) in data" :key="d">
                      <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                      <td style="vertical-align: middle;">{{ d.lembaga_unuja.nama_lembaga }}</td>
                      <td style="vertical-align: middle;">{{ d.tgl_pengajuan }}</td>
                      <td style="vertical-align: middle;">{{ d.tgl_penilaian }}</td>
                      <td style="vertical-align: middle;">{{ d.tgl_penilaian }}</td>
                      <td style="text-align: center; vertical-align: middle;"><a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i> Show Dokumen</a></td>
                      <td style="vertical-align: middle;">{{ d.nilai_lkps }}</td>
                      <td style="text-align: center; vertical-align: middle;">
                        <div v-if="d.status == 'a'">
                          <Link
                            :href="`/data-jenis-bab/${d.id_bab}/update_status`"
                            ><img src="@/Assets/on.png" />
                          </Link>
                        </div>
                        <div v-else>
                          <Link
                            :href="`/data-jenis-bab/${d.id_bab}/update_status`"
                            ><img src="@/Assets/off.png" />
                          </Link>
                        </div>
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
  </AdminLayout>
</template>
