<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
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
  status: props.data.status,
  create_by: props.data.create_by,
  update_by: props.data.update_by,
  delete_by: user,
});
</script>

<template>
  <Head title="Edit Status Lembaga Akreditasi" />

  <AdminLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i
                class="fas fa-cubes"
                style="margin-left: -10px; margin-rigth: 15px"
              ></i>
              <span class="ml-2 text-red" v-if="data.status == 'a'">
                <b>
                  Apakah Anda Yakin Ingin Menonaktifkan Lembaga Akreditasi Ini?
                </b>
              </span>
              <span class="ml-2 text-red" v-else>
                <b>
                  Apakah Anda Yakin Ingin Mengaktifkan Lembaga Akreditasi Ini?
                </b>
              </span>
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="form.post(`/data-lembaga-akreditasi/${data.id_lembaga_akreditasi}/update_status`)">
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
                        disabled
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
                        disabled
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
                        disabled
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
                        disabled
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
                        disabled
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"
                      >Status</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input type="hidden" v-model="form.status" >
                      <div v-if="data.status == 'a' ">
                        <input type="text" class="form-control" disabled value="Aktif">
                      </div>
                      <div v-else>
                        <input type="text" class="form-control" disabled value="Tidak Aktif">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: -30px">
                  <button type="submit" class="btn btn-primary mr-2">Ya</button>

                 <Link :href="`/data-lembaga-akreditasi`" class="btn btn-danger mr-2">
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
