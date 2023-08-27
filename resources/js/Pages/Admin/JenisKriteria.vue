<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import axios from "axios";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  kriteria: Object,
  la: Object,
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const form = useForm({
  id_sub_bab: "",
  nama_kriteria: "",
  deskripsi: "",
  create_by: user,
});

const submit = () => {
  form.post(route("data-jenis-kriteria.store"), {
    preserveScroll: true,
    onSuccess: () =>
      setTimeout(function () {
        window.location.reload();
      }, 500),
  });
};

const selectAkreditasi = ref("");
const selectBabs = ref("");
const Babs = ref([]);
const subBabs = ref([]);

async function loadselectAkreditasi() {
  if (selectAkreditasi.value) {
    const Bab = await axios.post("/babs-kriteria", {
      akreditasi_id: selectAkreditasi.value,
    });
    Babs.value = Bab.data;
    selectBabs = "";
  }
}

async function loadSelectBab() {
  if (selectBabs.value) {
    const subBab = await axios.post("/sub-babs-kriteria", {
      bab_id: selectBabs.value,
    });
    subBabs.value = subBab.data;
    form.id_sub_bab = ""; // Reset selected subBab when changing bab
  }
}
</script>

<template>
  <Head title="Data Jenis Kriteria" />

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
              Tambah Data Kriteria
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Nama Lembaga Akreditasi</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="selectAkreditasi"
                        class="form-control"
                        @change="loadselectAkreditasi"
                      >
                        <option value="#" disabled>
                          -- Pilih Nama Lembaga Akreditasi --
                        </option>
                        <option
                          v-for="sk in la"
                          :key="sk"
                          :value="`${sk.id_lembaga_akreditasi}`"
                        >
                          {{ sk.nama_lembaga }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama BAB</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="selectBabs"
                        class="form-control"
                        @change="loadSelectBab"
                      >
                        <option value="#" disabled>-- Pilih BAB --</option>
                        <option
                          v-for="b in Babs"
                          :key="b"
                          :value="`${b.id_bab}`"
                        >
                          {{ b.nama_bab }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Sub BAB</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <select v-model="form.id_sub_bab" class="form-control">
                        <option value="#" disabled>-- Pilih Sub BAB --</option>
                        <option
                          v-for="b in subBabs"
                          :key="b"
                          :value="`${b.id_sub_bab}`"
                        >
                          {{ b.nama_sub_bab }}
                        </option>
                      </select>
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_sub_bab"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
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
                    <label class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <textarea
                        cols="30"
                        rows="5"
                        class="form-control"
                        v-model="form.deskripsi"
                      ></textarea>
                      <InputError
                        class="mt-2"
                        :message="form.errors.deskripsi"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: 70px">
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
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="text-align: center; vertical-align: middle">
                          No
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Lembaga Akreditasi
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama BAB
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Sub BAB
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Kriteria
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Deskripsi
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Proses
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Status
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in kriteria" :key="d">
                        <td style="text-align: center; vertical-align: middle">
                          {{ x + 1 }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_lembaga }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_bab }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_sub_bab }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_kriteria }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.deskripsi }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <Link
                            :href="`/data-jenis-kriteria/${d.id_kriteria}/edit`"
                            class="btn btn-sm btn-success mr-1"
                          >
                            Edit</Link
                          >
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <div v-if="d.status == 'a'">
                            <Link
                              :href="`/data-jenis-kriteria/${d.id_kriteria}/update_status`"
                              ><img src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link
                              :href="`/data-jenis-kriteria/${d.id_kriteria}/update_status`"
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
