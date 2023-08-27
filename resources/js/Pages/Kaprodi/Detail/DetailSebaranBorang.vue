<script setup>
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref, computed } from "vue";
import axios from 'axios';

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const submit = () => {
  form.post(route("tambah-detail-pengajuan-baru.tambahDetailPengajuan"), {
    preserveScroll: true,
    onSuccess: () => setTimeout(function () {
      window.location.reload();
    }, 500),
  });
};

const props = defineProps({
  pa: Object,
  bab: Array,
  data: Array,
});

const form = useForm({
  id_pengajuan: props.pa.id_pengajuan,
  id_kriteria: "",
  deskripsi_isian: "",
  tgl_pengisian: "",
  create_by: user,
});

const deskripsiBab = ref('');
const selectBab = ref('');
const selectSubBab = ref('');
const sub_kriteria = ref('');
const subBabs = ref([]);
const kriteria = ref([]);
const subkriteria = ref([]);

async function loadSelectedBab() {
  if (selectBab.value) {
    const getDeskripsi = await axios.post('/deskripsi-babs', { bab_id: selectBab.value });
    const subBab = await axios.post('/sub-babs', { bab_id: selectBab.value });
    deskripsiBab.value = getDeskripsi.data;
    subBabs.value = subBab.data;
    form.id_sub_bab = ''; // Reset selected subBab when changing bab
    form.deskripsi_isian = deskripsiBab.value.deskripsi_bab; // Reset selected subBab when changing bab
  }
};

async function loadSelectedSubBab() {
  if (selectSubBab.value) {
    const getKriteria = await axios.post('/kriteria', { subbab_id: selectSubBab.value });
    kriteria.value = getKriteria.data;
    form.id_kriteria = ''; // Reset selected subBab when changing bab
  }
};

async function loadselectKriteria() {
  if (form.id_kriteria) {
    const subKriteria = await axios.post('/sub-kriteria', { kriteria_id: form.id_kriteria });
    subkriteria.value = subKriteria.data;
    sub_kriteria.value = ''; // Reset selected subBab when changing bab
  }
};
</script>


<template>
  <Head title=" Detail Pengajuan Akreditasi" />

  <KaprodiLayout>
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
              Detail Pengajuan Akreditasi
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Pengajuan Akreditasi</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_pengajuan"
                        class="form-control"
                        disabled
                      >
                        <option :value="`${pa.id_pengajuan}`">
                          {{
                            pa.lembaga_unuja.nama_lembaga
                          }}
                          -
                          {{
                            pa.lembaga_akreditasi.nama_lembaga
                          }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">BAB</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="selectBab"
                        class="form-control"
                        @change="loadSelectedBab"
                      >
                      <option value="#" disabled>-- Pilih Bab --</option>
                        <option
                          v-for="b in bab"
                          :key="b"
                          :value="`${b.id_bab}`"
                        >
                          {{ b.nama_bab }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Sub BAB</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="selectSubBab"
                        class="form-control"
                        @change="loadSelectedSubBab"
                      >
                        <option value="#" disabled>-- Pilih Sub Bab --</option>
                        <option
                          v-for="sk in subBabs"
                          :key="sk"
                          :value="`${sk.id_sub_bab}`"
                        >
                          {{ sk.nama_sub_bab }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Kriteria</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_kriteria"
                        class="form-control"
                        @change="loadselectKriteria"
                      >
                        <option value="#" disabled>-- Pilih Kriteria --</option>
                        <option
                          v-for="sk in kriteria"
                          :key="sk"
                          :value="`${sk.id_kriteria}`"
                        >
                          {{ sk.nama_kriteria }}
                        </option>
                      </select>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_kriteria"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Sub Kriteria</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <div class="border" v-if="subkriteria == 0">
                        <h6 class="mt-2 ml-3">
                          Silahkan pilih kriteria diatas.
                        </h6>
                      </div>
                      <div class="border" v-else>
                        <h6 class="mt-2 ml-3" v-for="s in subkriteria" :key="s">
                          {{ s.nama_sub_kriteria }}
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Tanggal Pengisian</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <input
                        type="date"
                        v-model="form.tgl_pengisian"
                        class="form-control"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.tgl_pengisian"
                      />
                    </div>
                  </div>
                  <div v-if="deskripsiBab.deskripsi_bab != NULL" class="form-group row">
                    <label class="col-sm-4 mt-1">Deskripsi Isian</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <textarea
                        v-model="form.deskripsi_isian"
                        cols="30"
                        rows="5"
                        class="form-control"
                        disabled
                      ></textarea>
                    </div>
                  </div>
                  <div v-else class="form-group row">
                    <label class="col-sm-4 mt-1">Deskripsi Isian</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <textarea
                        disabled
                        cols="30"
                        rows="5"
                        class="form-control"
                      >Silahkan pilih BAB.</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="form-group row" style="margin-left: -45px">
                  <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                  <button class="btn btn-danger" type="reset">Batal</button>
                </div>
              </div>
            </div>
          </form>
          <hr />

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
                    Detail Pengajuan Akreditasi
                  </h3>
                </div>
                <div class="card-body">
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                      <th style="vertical-align: middle;">No</th>
                      <th style="vertical-align: middle;">Nama Lembaga Akreditasi</th>
                      <th style="vertical-align: middle;">BAB</th>
                      <th style="vertical-align: middle;">Sub BAB</th>
                      <th style="vertical-align: middle;">Kriteria</th>
                      <th style="text-align: center; vertical-align: middle;">Proses</th>
                      <th style="text-align: center; vertical-align: middle;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in data" :key="d">
                        <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_lembaga }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_bab }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_sub_bab }}</td>
                        <td style="vertical-align: middle;">{{ d.nama_kriteria }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ d.Percentage }}%</td>
                        <td style="text-align: center; vertical-align: middle;">
                          <Link
                            :href="`/upload-dokumen-akreditasi/3jy4h6n8m3${d.id_detail_pengajuan}p0c13x/prodi`"
                            class="btn btn-sm btn-success mr-1"
                            ><i class="fas fa-file"></i> Upload Dokumen
                          </Link>
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
  </KaprodiLayout>
</template>
