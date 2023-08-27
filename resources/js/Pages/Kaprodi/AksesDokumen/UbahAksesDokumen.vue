<script setup>
import AdminLayout from "@/Layouts/KaprodiLayout.vue";
import { Head, Link , useForm, usePage } from "@inertiajs/vue3";

import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);


const props = defineProps({
  data: Object,
});

const form = useForm({
  nama_lembaga: props.data.create_by,
  nama_dokumen: props.data.nama_dokumen,
  akses_dokumen: props.data.akses_dokumen,
  update_by: user,
});

</script>

<template>
  <Head title="Edit Akses Dokumen LKPS" />

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
       <div class="card card-light">
         <div class="card-header">
           <h3 class="card-title">
             <i
               class="fas fa-cubes"
               style="margin-left: -10px; margin-rigth: 5px"
             ></i>
             <span class="ml-2 text-red" v-if="data.akses_dokumen == 'bisa'">
               <b>
                 Apakah Anda Yakin Ingin Merubah Akses Dokumen Ini Menjadi Tidak Bisa di Akses?
               </b>
             </span>
             <span class="ml-2 text-red" v-else>
               <b>
                 Apakah Anda Yakin Ingin Merubah Akses Dokumen Ini Menjadi Bisa di Akses?
               </b>
             </span>
           </h3>
         </div>
         <form class="form-horizontal" @submit.prevent="form.post(`/upload-berkas-lkps-prodi/RMslre3M9qEym${data.id_pengajuan_lkps}4WBRLv4AoZ/update_akses`)">
           <div class="card-body">
             <div class="row justify-content-center">
               <div class="col-lg-8">
                 <div class="form-group row">
                   <label class="col-sm-5 col-form-label"
                     >Nama Lembaga</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-6">
                     <input
                       type="text"
                       class="form-control"
                       v-model="form.nama_lembaga"
                       placeholder="Nama Lembaga"
                       disabled
                     />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-5 col-form-label"
                     >Nama Dokumen</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-6">
                     <input
                       type="text"
                       class="form-control"
                       v-model="form.nama_dokumen"
                       placeholder="Nama Dokumen"
                       disabled
                     />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-5 col-form-label"
                     >Status Akses Dokumen (Bisa/Tidak Bisa)</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-6">
                     <input
                       v-model="form.akses_dokumen"
                       type="hidden"
                       class="form-control"
                     />
                     <div v-if="data.akses_dokumen == 'bisa'">
                       <input
                         value="Bisa diakses prodi lain"
                         disabled
                         type="text"
                         class="form-control"
                       />
                     </div>
                     <div v-else>
                       <input
                         value="Tidak Bisa diakses prodi lain"
                         disabled
                         type="text"
                         class="form-control"
                       />
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row justify-content-center mt-1">
               <div class="form-group row" style="margin-left: 65px">
                 <button class="btn btn-primary mr-2" type="submit">Ya</button>
                 <Link :href="`/upload-lkps-prodi`" class="btn btn-danger mr-2">
                   Kembali
                 </Link>
               </div>
             </div>
           </div>
         </form>
       </div>
     </section>
   </div>
  </AdminLayout>
</template>
