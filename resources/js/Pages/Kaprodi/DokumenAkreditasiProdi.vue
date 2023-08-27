<script setup>
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

import { computed } from "vue";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  list_data: Object,
  detail_pengajuan: Object,
});

const form = useForm({
  nama_lembaga: props.detail_pengajuan.nama_lembaga,
  nama_bab: props.detail_pengajuan.nama_bab,
  deskripsi_bab: props.detail_pengajuan.deskripsi_bab,
  nama_dokumen: "",
  akses_dokumen: "",
  patch_dokumen: "",
  id_detail_pengajuan: props.detail_pengajuan.id_detail_pengajuan,
  create_by: user,
});

const submit = () => {
  form.post(route("pengajuan-akreditasi-prodi.Simpan"), {
    preserveScroll: true,
    onSuccess: () => setTimeout(function () {
      window.location.reload();
    }, 500)
  })
};

$(function () {
  bsCustomFileInput.init();
});
</script>


<template>
  <Head title="Dokumentasi Akreditasi" />

  <KaprodiLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $page.props.flash.message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
              Dokumen Akreditasi
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label>Nama Lembaga Akreditasi : </label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" disabled v-model="form.nama_lembaga" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label>Nama BAB : </label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" disabled v-model="form.nama_bab" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label>Deskripsi : </label>
                        </div>
                        <div class="col-sm-7">
                          <textarea disabled v-model="form.deskripsi_bab" cols="30" rows="3"
                            class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label> Nama Dokumen : </label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" placeholder="Nama Dokumen"
                            v-model="form.nama_dokumen" />

                          <InputError class="mt-2" :message="form.errors.nama_dokumen" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label> Status Akses Dokumen : </label>
                        </div>
                        <div class="col-sm-7">
                          <select class="form-control" v-model="form.akses_dokumen">
                            <option>--Silahkan pilih status akses dokumen anda--</option>
                            <option value="bisa">Bisa diakses prodi lain</option>
                            <option value="tidak">Tidak Bisa diakses prodi lain</option>
                          </select>

                          <InputError class="mt-2" :message="form.errors.akses_dokumen" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group row">
                        <div class="col">
                          <label>Dokumen : </label>
                        </div>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" accept="application/pdf, application/msword"
                                @input="
                                  form.patch_dokumen = $event.target.files[0]
                                  " id="exampleInputFile" />
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>

                          <InputError class="mt-2" :message="form.errors.patch_dokumen" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="form-group row" style="margin-left: 55px">
                  <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                  <Link class="btn btn-danger" :href="`/pengajuan-akreditasi-prodi/Zdo9k1lysUiwHuKn${props.detail_pengajuan.id_pengajuan}Dxs2oXPIGi/detail`">
                    Kembali
                  </Link>
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
                    <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
                    Detail Dokumen Akreditasi
                  </h3>
                </div>
                <div class="card-body">
                  <DataTable class="display table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="text-align: center; vertical-align: middle">
                          No
                        </th>
                        <th style="vertical-align: middle">
                          Nama Lembaga
                        </th>
                        <th style="vertical-align: middle">
                          Nama Dokumen
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Show Dokumen
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Akses Dokumen
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in list_data" :key="d">
                        <td style="text-align: center; vertical-align: middle">
                          {{ x + 1 }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.lembaga }} - {{ d.akreditasi }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_dokumen }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i
                              class="fas fa-eye"></i> Show Dokumen</a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                          <div v-if="d.akses_dokumen == 'bisa'">
                            <Link :href="`/dokumen-akreditasi/5b1nms38zz${d.id_dokumen}8q0r2y/update_akses`"><img
                              src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link :href="`/dokumen-akreditasi/5b1nms38zz${d.id_dokumen}8q0r2y/update_akses`"><img
                              src="@/Assets/off.png" />
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
  </KaprodiLayout>
</template>
