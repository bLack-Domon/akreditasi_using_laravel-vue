<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link , useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  data: Object,
});

const form = useForm({
  nama_lembaga: props.data.nama_lembaga,
  status_akun: props.data.status_akun,
  user: props.data.user,
  status_aktif: props.data.status_aktif,
  create_by: props.data.create_by,
  update_by: props.data.update_by,
  delete_by: user,
});

</script>

<template>
  <Head title="Edit Status Lembaga Unuja" />

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
             <span class="ml-2 text-red" v-if="data.status_aktif == 'a'">
               <b>
                 Apakah Anda Yakin Ingin Menonaktifkan Lembaga Unuja Ini?
               </b>
             </span>
             <span class="ml-2 text-red" v-else>
               <b>
                 Apakah Anda Yakin Ingin Mengaktifkan Lembaga Unuja Ini?
               </b>
             </span>
           </h3>
         </div>
         <form class="form-horizontal" @submit.prevent="
         form.post(`/data-lembaga-unuja/${data.id_lembaga}/update_status`)">
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
              <input
                type="hidden"
                class="form-control mb-2"
                id="create_by"
                v-model="form.delete_by"
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
                       disabled
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
                     <select v-model="form.status_akun" disabled class="form-control">
                       <option value="kaprodi">Prodi</option>
                       <option value="lembaga">Lembaga</option>
                     </select>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.status_akun"
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
                       disabled
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
                       disabled
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
                 <div class="form-group row">
                   <label class="col-sm-4 col-form-label"
                     >Status (Aktif/Tidak Aktif)</label
                   >
                   <div class="col-sm-auto" style="margin-top: 6px">:</div>
                   <div class="col-sm-7">
                     <input
                       v-model="form.status_aktif"
                       type="hidden"
                       class="form-control"
                     />
                     <div v-if="data.status_aktif == 'a'">
                       <input
                         value="Aktif"
                         disabled
                         type="text"
                         class="form-control"
                       />
                     </div>
                     <div v-else>
                       <input
                         value="Tidak Aktif"
                         disabled
                         type="text"
                         class="form-control"
                       />
                     </div>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.password"
                      />
                   </div>
                 </div>
               </div>
             </div>
             <div class="row justify-content-center mt-1">
               <div class="form-group row" style="margin-left: -30px">
                 <button class="btn btn-primary mr-2" type="submit">Ya</button>
                 <Link :href="`/data-lembaga-unuja`" class="btn btn-danger mr-2">
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
