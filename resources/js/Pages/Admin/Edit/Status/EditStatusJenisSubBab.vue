<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);
 
const props = defineProps({
  data: Object,
  bab: Object,
});

const form = useForm({
  id_bab: props.data.id_bab,
  nama_sub_bab: props.data.nama_sub_bab,
  deskripsi_sub_bab: props.data.deskripsi_sub_bab,
  status: props.data.status,
  create_by: props.data.create_by,
  update_by: props.data.update_by,
  delete_by: user,
});
</script>

<template>
  <Head title="Edit Status Sub BAB" />

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
              <span class="ml-2 text-red" v-if="data.status == 'a'">
                <b>
                  Apakah Anda Yakin Ingin Menonaktifkan Sub Bab Ini?
                </b>
              </span>
              <span class="ml-2 text-red" v-else>
                <b>
                  Apakah Anda Yakin Ingin Mengaktifkan Sub Bab Ini?
                </b>
              </span>
            </h3>
          </div>
          <form
            class="form-horizontal"
            @submit.prevent="form.post(`/data-jenis-sub-bab/${data.id_sub_bab}/update_status`)"
          >
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
                      >Nama BAB</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_bab"
                        disabled
                        class="form-control"
                        onChange="{onHandleChange}"
                      >
                        <option
                          v-for="b in bab"
                          :key="b"
                          :value="`${b.id_bab}`"
                        >
                          {{ b.nama_bab }}
                        </option>
                      </select>
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_bab"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Nama Sub BAB</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input type="text" 
                      disabled
                      class="form-control" v-model="form.nama_sub_bab" placeholder="Nama Sub BAB">
                      <InputError
                        class="mt-2"
                        :message="form.errors.nama_sub_bab"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <textarea
                        v-model="form.deskripsi_sub_bab"
                        disabled
                        cols="30"
                        rows="5"
                        class="form-control"
                      ></textarea>
                      <InputError
                        class="mt-2"
                        :message="form.errors.deskripsi_sub_bab"
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
                       v-model="form.status"
                       type="hidden"
                       class="form-control"
                     />
                     <div v-if="data.status == 'a'">
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
                <div class="form-group row" style="margin-left: -40px">
                  <button type="submit" class="btn btn-primary mr-2">
                    Ya
                  </button>
                  <Link :href="`/data-jenis-sub-bab`" class="btn btn-danger mr-2">
                    Tidak
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
