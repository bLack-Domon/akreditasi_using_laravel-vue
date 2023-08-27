<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { computed } from "vue";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  data: Object,
  pengajuan_akreditasi: Object,
  sub_kriteria: Object,
  sub_bab: Object,
});

const form = useForm({
  id_pengajuan: props.pengajuan_akreditasi.id_pengajuan,
  id_sub_kriteria: "",
  id_sub_bab: "",
  deskripsi_isian: "",
  tgl_pengisian: "",
  create_by: user,
});

const submit = () => {
  form.post(route("tambah-detail-pengajuan-baru.tambahDetailPengajuan"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  }),
    setTimeout(function () {
      window.location.reload();
    }, 3000);
};
</script>


<template>
  <Head title=" Detail Pengajuan Akreditasi" />

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
                        onChange="{onHandleChange}"
                        disabled
                      >
                        <option :value="`${pengajuan_akreditasi.id_pengajuan}`">
                          {{
                            pengajuan_akreditasi.lembaga_unuja.nama_lembaga
                          }}
                          -
                          {{
                            pengajuan_akreditasi.lembaga_akreditasi.nama_lembaga
                          }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Sub BAB</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_sub_bab"
                        class="form-control"
                        onChange="{onHandleChange}"
                      >
                        <option
                          v-for="sk in sub_bab"
                          :key="sk"
                          :value="`${sk.id_sub_bab}`"
                        >
                          {{ sk.bab.nama_bab }} -
                          {{ sk.nama_sub_bab }}
                        </option>
                      </select>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_sub_kriteria"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Sub Kriteria</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_sub_kriteria"
                        class="form-control"
                        onChange="{onHandleChange}"
                      >
                        <option
                          v-for="sk in sub_kriteria"
                          :key="sk"
                          :value="`${sk.id_sub_kriteria}`"
                        >
                          {{ sk.kriteria.nama_kriteria }} -
                          {{ sk.nama_sub_kriteria }}
                        </option>
                      </select>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_sub_kriteria"
                      />
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
                  <div class="form-group row">
                    <label class="col-sm-4 mt-1">Deskripsi Isian</label>
                    <div class="col-sm-auto" style="margin-top: 3px">:</div>
                    <div class="col-sm-7">
                      <textarea
                        v-model="form.deskripsi_isian"
                        cols="30"
                        rows="5"
                        class="form-control"
                      ></textarea>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.deskripsi_isian"
                      />
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
                      <th>No</th>
                      <th>Pengajuan Akreditasi</th>
                      <th>Sub Kriteria</th>
                      <th>Sub Bab</th>
                      <th>Aksi</th>
                      <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in data" :key="d">
                        <td style="text-align: center; vertical-align: middle;">{{ x + 1 }}</td>
                        <td style="vertical-align: middle;">{{ pengajuan_akreditasi.lembaga_unuja.nama_lembaga }} - {{ pengajuan_akreditasi.lembaga_akreditasi.nama_lembaga }} </td>
                        <td style="vertical-align: middle;">{{ d.sub_kriteria.nama_sub_kriteria }}</td>
                        <td style="vertical-align: middle;">{{ d.sub_bab.nama_sub_bab }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                          <Link
                            :href="`/detail-dokumen-akreditasi/${d.id_detail_pengajuan}`"
                            class="btn btn-sm btn-success mr-1"
                            >Detail
                          </Link>
                        </td>
                        <td  style="text-align: center; vertical-align: middle;">
                          <div v-if="d.status == 'a'">
                            <Link
                              :href="`/detail-pengajuan-akreditasi/${d.id_detail_pengajuan}/update_status`"
                              ><img src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link
                              :href="`/detail-pengajuan-akreditasi/${d.id_detail_pengajuan}/update_status`"
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
