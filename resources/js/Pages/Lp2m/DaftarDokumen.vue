<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

const props = defineProps({
  info_dokumen: Object,
});
</script>

<template>
  <Head title="Penilaian Dokumen" />

  <AdminLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <!-- table -->
        <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $page.props.flash.message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
              Daftar Dokumen Akreditasi
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
                    Link Dokumen
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(d, x) in info_dokumen" :key="d">
                  <td style="text-align: center; vertical-align: middle">
                    {{ x + 1 }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.create_by }}
                  </td>
                  <td style="vertical-align: middle">
                    {{ d.nama_dokumen }}
                  </td>
                  <td style="text-align: center; vertical-align: middle">
                    <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i
                        class="fas fa-eye"></i> Show Dokumen</a>
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
