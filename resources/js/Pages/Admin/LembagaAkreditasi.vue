<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
  LembagaAkreditasi: Object, //menampilkan data
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const form = useForm({
  //form untuk input data
  nama_lembaga: '',
  alamat: '',
  tlp: '',
  email: '',
  website: '',
  create_by: user,
});

const submit = () => {
  form.post(route("data-lembaga-akreditasi.store"), {
    preserveScroll: true,
    onSuccess: () =>  setTimeout(function () {
      window.location.reload();
    }, 500)
  })
};

</script>

<template>
  <Head title="Data Lembaga Akreditasi" />

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
              Tambah Lembaga Akreditasi
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
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
                      <TextInput
                        id="nama_lembaga"
                        v-model="form.nama_lembaga"
                        type="text"
                        class="form-control"
                        placeholder="Nama Lembaga Akreditasi"
                        autofocus
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
                      <TextInput
                        id="alamat"
                        v-model="form.alamat"
                        type="text"
                        class="form-control"
                        placeholder="Alamat Lengkap"
                      />

                      <InputError class="mt-2" :message="form.errors.alamat" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Telepon</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <TextInput
                        id="tlp"
                        v-model="form.tlp"
                        type="text"
                        class="form-control"
                        placeholder="Nomer Handphone"
                      />

                      <InputError class="mt-2" :message="form.errors.tlp" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        placeholder="Email"
                      />

                      <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Website</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <TextInput
                        id="website"
                        v-model="form.website"
                        type="text"
                        class="form-control"
                        placeholder="Website"
                      />

                      <InputError class="mt-2" :message="form.errors.website" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: 100px">
                  <button type="submit" class="btn btn-primary mr-2">
                    Simpan
                  </button>

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
                    Detail Lembaga Akreditasi
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
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                      <th style="text-align: center; vertical-align: middle;">No</th>
                      <th style="text-align: center; vertical-align: middle;">Nama Lembaga</th>
                      <th style="text-align: center; vertical-align: middle;">Alamat</th>
                      <th style="text-align: center; vertical-align: middle;">Telepon</th>
                      <th style="text-align: center; vertical-align: middle;">Email</th>
                      <th style="text-align: center; vertical-align: middle;">Website</th>
                      <th style="text-align: center; vertical-align: middle;">Proses</th>
                      <th style="text-align: center; vertical-align: middle;">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr  v-for="(d, x) in LembagaAkreditasi" :key="d">
                        <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_lembaga }}</td>
                        <td style="vertical-align: middle;">{{ d.alamat }}</td>
                        <td style="vertical-align: middle;">{{ d.tlp }}</td>
                        <td style="vertical-align: middle;">{{ d.email }}</td>
                        <td style="vertical-align: middle;">{{ d.website }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                          <Link
                            :href="`/data-lembaga-akreditasi/${d.id_lembaga_akreditasi}/edit`"
                            class="btn btn-sm btn-success mr-1"
                            >Edit</Link
                          >
<!-- 
                          <Link
                            :href="`/data-lembaga-akreditasi/${d.id_lembaga_akreditasi}`"
                            class="btn btn-sm btn-danger"
                            method="delete"
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            >Hapus</Link
                          > -->
                        </td>
                        <td  style="text-align: center; vertical-align: middle;">
                          <div v-if="d.status == 'a'">
                            <Link
                              :href="`/data-lembaga-akreditasi/${d.id_lembaga_akreditasi}/update_status`"
                              ><img src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link
                              :href="`/data-lembaga-akreditasi/${d.id_lembaga_akreditasi}/update_status`"
                              ><img src="@/Assets/off.png" />
                            </Link>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </DataTable>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </AdminLayout>
</template>
