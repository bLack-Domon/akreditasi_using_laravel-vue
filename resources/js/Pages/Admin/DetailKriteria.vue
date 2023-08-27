<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
  data: Object,
  bab: Object,
  kriteria: Object,
  subkriteria: Object,
});

const form = useForm({
  id_detail_bab : '',
  id_kriteria : '',
  id_sub_kriteria : '',
});

</script>

<template>
  <Head title="Data Detail Kriteria" />

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
             Tambah Data Detail Kriteria
           </h3>
         </div>
         <form class="form-horizontal">
           <div class="card-body">
             <div class="form-group row">
               <div class="form-check ml-2">
                 <input class="form-check-input" type="radio" name="" id="" />
                 <label class="form-check-label" for="">
                   Perguruan Tinggi
                 </label>
               </div>
               <div class="form-check ml-5">
                 <input class="form-check-input" type="radio" name="" id="" />
                 <label class="form-check-label" for=""> Program Studi </label>
               </div>
             </div>
             <div class="form-group row">
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-6">
                     <label for="">Lembaga Akreditasi :</label>
                   </div>
                   <div class="col-sm-6">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih Lembaga</option>
                     </select>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-4">
                     <label for="" style="margin-left:10px">Nama BAB :</label>
                   </div>
                   <div class="col-sm-8">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih BAB</option>
                     </select>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-5">
                     <label for="" style="margin-left:10px">Sub BAB :</label>
                   </div>
                   <div class="col-sm-7">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih Sub BAB</option>
                     </select>
                   </div>
                 </div>
               </div>
             </div>
             <div class="form-group row">
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-6">
                     <label for="">Nama Kriteria :</label>
                   </div>
                   <div class="col-sm-6">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih Kriteria</option>
                     </select>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-4">
                     <label for="" style="margin-left:10px">Sub Kriteria :</label>
                   </div>
                   <div class="col-sm-8">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih Sub Kriteria</option>
                     </select>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group row">
                   <div class="col-lg-5">
                     <label for="" style="margin-left:10px">Nama Lembaga :</label>
                   </div>
                   <div class="col-sm-7">
                     <select name="" id="" class="form-control">
                       <option value="">Pilih Lembaga</option>
                     </select>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row justify-content-center mt-1">
               <div class="form-group row" style="margin-left: -20px">
                 <button class="btn btn-primary mr-2">Simpan</button>
                 <button class="btn btn-danger mr-2" type="reset">
                   Batal
                 </button>
                 <button type="submit" class="btn btn-success">
                   Import Data
                 </button>
               </div>
             </div>
           </div>
         </form>



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
                   Detail Data Sub Kriteria
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
                 <table class="table table-striped table-bordered">
                   <tr>
                     <th>No</th>
                     <th>Nama Sub BAB</th>
                     <th>Deskripsi</th>
                     <th>Proses</th>
                   </tr>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
   </div>
  </AdminLayout>
</template>
