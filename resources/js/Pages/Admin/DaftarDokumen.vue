<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  data: Object
})

import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}
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
            Data Dokumen Akreditasi
          </h3>
        </div>
        
        <div class="card-body">
         <DataTable class="display table table-striped table-bordered">
           <thead>
             <tr>
             <th style="text-align: center; vertical-align: middle;">No</th>
             <th style="vertical-align: middle;">Nama Lembaga</th>
             <th style="text-align: center; vertical-align: middle;">Tanggal Pengajuan</th>
             <th style="vertical-align: middle;">Nama Dokumen</th>
             <th style="text-align: center; vertical-align: middle;">Show Dokumen</th>
             </tr>
           </thead>
           <tbody>
             <tr v-for="(d, x) in data" :key="d">
               <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
               <td style="vertical-align: middle;">{{ d.create_by }}</td>
               <td style="text-align: center; vertical-align: middle;">{{ dateFormat(d.create_date) }}</td>
               <td style="vertical-align: middle;">{{ d.nama_dokumen }}</td>
               <td style="text-align: center; vertical-align: middle;"><a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i> Show Dokumen</a></td>
             </tr>
           </tbody>
         </DataTable>
       </div>
      </div>
    </section>
  </div>
  </AdminLayout>
</template>
