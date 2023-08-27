<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link , useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  data: Object,
  fakultas: Object,
});

const form = useForm({
  nama_lembaga: props.data.nama_lembaga,
  status_akun: props.data.status_akun,
  fakultas: props.data.id_fakultas,
  user: props.data.user,
  password: null,
  create_by: props.data.create_by,
  update_by: user,
});

</script>

<template>
  <Head title="Edit Data Lembaga Unuja" />

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
             Edit Lembaga Unuja
           </h3>
         </div>
         <form class="form-horizontal" @submit.prevent="
         form.put(`/data-lembaga-unuja/${data.id_lembaga}`)">
           <div class="card-body">
             <div class="row justify-content-center">
              <input
                type="hidden"
                class="form-control mb-2"
                id="update_by"
                v-model="form.update_by"
              />
              <input
                type="hidden"
                class="form-control mb-2"
                id="create_by"
                v-model="form.create_by"
              />
               <div class="col-lg-7">
                 <div class="form-group row">
                   <label class="col-sm-4 col-form-label"
                     >Nama Lembaga Unuja</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <input
                       type="text"
                       class="form-control"
                       v-model="form.nama_lembaga"
                       placeholder="Nama Lembaga"
                     />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.nama_lembaga"
                      />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-4 col-form-label"
                     >Status</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <select v-model="form.status_akun" class="form-control">
                       <option value="kaprodi">Prodi</option>
                       <option value="lembaga">Lembaga</option>
                     </select>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.status_akun"
                      />
                   </div>
                 </div>
                 <div v-if="'kaprodi' == `${form.status_akun}`" class="form-group row">
                   <label class="col-sm-4 col-form-label">Nama Fakultas</label>
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <select v-model="form.fakultas" class="form-control" onChange="{onHandleChange}">
                         <option v-for="f in fakultas" :key="f" :value="`${f.id_lembaga}`">{{ f.nama_lembaga }}</option>
                     </select>
                     
                     <InputError
                       class="mt-2"
                       :message="form.errors.fakultas"
                     />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-4 col-form-label"
                     >User</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <input
                       type="text"
                       class="form-control"
                       v-model="form.user"
                       placeholder="Username"
                     />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.user"
                      />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="col-sm-4 col-form-label"
                     >Password</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <input
                       v-model="form.password"
                       type="password"
                       class="form-control"
                       placeholder="Password"
                     />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.password"
                      />
                   </div>
                 </div>
               </div>
             </div>
             <div class="row justify-content-center mt-1">
               <div class="form-group row" style="margin-left: 100px">
                 <button class="btn btn-primary mr-2" type="submit">Update</button>
                 <Link :href="`/data-lembaga-unuja`" class="btn btn-danger mr-2">
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
                 Detail Data Lembaga Unuja
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
               <thead>
                <th>No</th>
                <th>Nama Lembaga</th>
                <th>User</th>
                <th>Proses</th>
               </thead>
               <tbody>
               </tbody>
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
