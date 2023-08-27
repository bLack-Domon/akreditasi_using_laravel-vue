<script setup>
import LembagaLayout from '@/Layouts/LembagaLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data: Object
});
</script>

<template>
    <Head title="Pengajuan Akreditasi" />

    <LembagaLayout>
        <div class="row">
          <section class="col-lg-12 mt-3 connectedSortable">
            <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">
                  <i
                    class="fas fa-cubes"
                    style="margin-left: -10px; margin-rigth: 5px"
                  ></i>
                  Daftar Prodi - {{ $page.props.auth.user.nama_lembaga }}
                </h3>
              </div>
              <div class="card-body">
                <DataTable class="display table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center; vertical-align: middle">
                        No
                      </th>
                      <th style="vertical-align: middle">
                        Nama Prodi
                      </th>
                      <th style="text-align: center; vertical-align: middle">
                        Detail Pengajuan Berkas
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(d, index) in data" :key="d">
                      <td style="text-align: center; vertical-align: middle">
                        {{ index + 1 }}
                      </td>
                      <td style="vertical-align: middle">
                        {{ d.nama_lembaga }}
                      </td>
                      <td style="text-align: center; vertical-align: middle">
                        <Link
                          :href="`/pengajuan-akreditasi-prodi/y$10$YHn${d.id_lembaga}6lEhR/cek`"
                          class="btn btn-sm btn-success mr-1"
                          ><i class="fas fa-eye"></i> Cek Pengajuan
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
