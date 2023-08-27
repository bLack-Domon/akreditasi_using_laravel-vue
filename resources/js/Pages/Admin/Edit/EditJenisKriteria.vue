<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  data: Object,
  bab: Object,
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const form = useForm({
  id_sub_bab: props.data.id_sub_bab,
  nama_kriteria: props.data.nama_kriteria,
  deskripsi: props.data.deskripsi,
  create_by: props.data.create_by,
  update_by: user,
});
</script>

<template>
  <Head title="Edit Data Jenis Kriteria" />

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
             Edit Data Kriteria
           </h3>
         </div>
         <form class="form-horizontal" @submit.prevent="form.put(`/data-jenis-kriteria/${data.id_kriteria}`)">
           <div class="card-body">
             <div class="row justify-content-center">
               <div class="col-lg-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label"
                    >Nama BAB</label
                  >
                  <div class="col-sm-auto" style="margin-top: 6px">:</div>
                  <div class="col-sm-8">
                    <select
                      v-model="form.id_sub_bab"
                      class="form-control"
                      onChange="{onHandleChange}"
                    >
                      <option
                        v-for="b in bab"
                        :key="b"
                        :value="`${b.id_sub_bab}`"
                      >
                      {{ b.bab.nama_bab }} - {{ b.nama_sub_bab }}
                      </option>
                    </select>
                    <InputError
                      class="mt-2"
                      :message="form.errors.id_sub_bab"
                    />
                  </div>
                </div>
                 <div class="form-group row">
                   <label class="col-sm-3 col-form-label"
                     >Nama Kriteria</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-8">
                     <input
                       type="text"
                       class="form-control"
                       v-model="form.nama_kriteria"
                       placeholder="Nama Kriteria"
                     />
                     <InputError
                       class="mt-2"
                       :message="form.errors.nama_kriteria"
                     />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-3 col-form-label"
                     >Deskripsi</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-8">
                     <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="form.deskripsi"></textarea>
                     <InputError
                       class="mt-2"
                       :message="form.errors.deskripsi"
                     />
                   </div>
                 </div>
               </div>
             </div>
             <div class="row justify-content-center mt-1">
               <div class="form-group row" style="margin-left: 45px">
                 <button class="btn btn-primary mr-2" type="submit">Update</button>
                 <Link :href="`/data-jenis-kriteria`" class="btn btn-danger mr-2">
                   Batal
                 </Link>
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
                 Detail Data Kriteria
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
                <th>Nama Kriteria</th>
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
