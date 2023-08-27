<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";

import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  data: Object,
});

const form = useForm({ //form untuk input data
  nama_lembaga: props.data.nama_lembaga,
  alamat: props.data.alamat,
  tlp: props.data.tlp,
  email: props.data.email,
  website: props.data.website,
  create_by: props.data.create_by,
  update_by: user,
});
</script>

<template>
  <Head title="Data Lembaga Akreditasi" />

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
              Edit Lembaga Akreditasi
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="form.put(`/data-lembaga-akreditasi/${data.id_lembaga_akreditasi}`)">
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
                      >Nama Lembaga Akreditasi</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        v-model="form.nama_lembaga"
                        type="text"
                        class="form-control"
                        placeholder="Nama Lembaga Akreditasi"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.nama_lembaga"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Alamat Lengkap</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        v-model="form.alamat"
                        type="text"
                        class="form-control"
                        placeholder="Alamat Lengkap"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.alamat"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Telepon</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                      v-model="form.tlp"
                        type="text"
                        class="form-control"
                        placeholder="Nomer Handphone"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.tlp"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Email</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        placeholder="Email"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.email"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Website</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                      v-model="form.website"
                        type="text"
                        class="form-control"
                        placeholder="Website"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.website"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: 100px">
                  <button type="submit" class="btn btn-primary mr-2">Update</button>

                 <Link :href="`/data-lembaga-akreditasi`" class="btn btn-danger mr-2">
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
                  Detail Pelanggan
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
                 <th>Alamat</th>
                 <th>Telepon</th>
                 <th>Email</th>
                 <th>Website</th>
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
