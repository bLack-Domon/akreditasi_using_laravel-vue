<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  LembagaUnuja: Object,
  fakultas: Object,
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const form = useForm({
  nama_lembaga: '',
  status_akun: '',
  fakultas: '',
  user: '',
  password: '',
  create_by: user,
});


const submit = () => {
  form.post(route("data-lembaga-unuja.store"), {
    preserveScroll: true,
    onSuccess: () => setTimeout(function () {
      window.location.reload();
    }, 500)
  })
};

</script>

<template>
  <Head title="Data Lembaga Unuja" />

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
              Tambah Lembaga Unuja
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
                      >Nama Lembaga Unuja</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <TextInput
                        type="text"
                        class="form-control"
                        v-model="form.nama_lembaga"
                        placeholder="Nama Lembaga"
                        autofocus
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.nama_lembaga"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status</label>
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
                    <label class="col-sm-4 col-form-label">User</label>
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
                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        type="password"
                        class="form-control"
                        v-model="form.password"
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
                  <button class="btn btn-primary mr-2" type="submit">
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
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                      <th style="text-align: center; vertical-align: middle;">No</th>
                      <th style="text-align: center; vertical-align: middle;">Nama Lembaga</th>
                      <th style="text-align: center; vertical-align: middle;">Status Prodi / Lembaga</th>
                      <th style="text-align: center; vertical-align: middle;">User</th>
                      <th style="text-align: center; vertical-align: middle;">Proses</th>
                      <th style="text-align: center; vertical-align: middle;">Status Aktif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in LembagaUnuja" :key="d">
                        <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_lembaga }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ d.status_akun }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ d.user }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                          <Link
                            :href="`/data-lembaga-unuja/${d.id_lembaga}/edit`"
                            class="btn btn-sm btn-success mr-1"
                            >Edit</Link
                          >

                          <!-- <Link
                            :href="`/data-lembaga-unuja/${d.id_lembaga}`"
                            class="btn btn-sm btn-danger"
                            method="delete"
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            >Hapus</Link
                          > -->
                        </td>
                        <td  style="text-align: center; vertical-align: middle;">
                          <div v-if="d.status_aktif == 'a'">
                            <Link
                              :href="`/data-lembaga-unuja/${d.id_lembaga}/update_status`"
                              ><img src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link
                              :href="`/data-lembaga-unuja/${d.id_lembaga}/update_status`"
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
