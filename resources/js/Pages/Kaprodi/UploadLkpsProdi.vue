<script setup>
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  DataLkps: Object, //menampilkan data
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);
const user_id = computed(() => page.props.auth.user.id_lembaga);

const form = useForm({
  //form untuk input data
  id_lembaga: user_id,
  nama_lembaga: user,
  nama_dokumen: "",
  akses_dokumen: "",
  patch_dokumen: "",
  create_by: user,
});

const submit = () => {
  form.post(route("upload-lkps-prodi.store"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  }),
    setTimeout(function () {
      window.location.reload();
    }, 3000);
};

$(function () {
  bsCustomFileInput.init();
});
</script>

<template>
  <Head title="Upload LKPS" />

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
              Upload LKPS Prodi - {{ $page.props.auth.user.nama_lembaga }}
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lembaga</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <TextInput id="nama_lembaga" type="text" class="form-control"
                        :placeholder="`${user}`" disabled />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Dokumen</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <TextInput id="nama_lembaga" v-model="form.nama_dokumen" type="text" class="form-control"
                        placeholder="Nama Dokumen" />

                      <InputError class="mt-2" :message="form.errors.nama_dokumen" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3"> Status Akses Dokumen : </label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <select class="form-control" v-model="form.akses_dokumen">
                        <option>--Silahkan pilih akses dokumen anda--</option>
                        <option value="bisa">Bisa diakses prodi lain</option>
                        <option value="tidak">Tidak Bisa diakses prodi lain</option>
                      </select>

                      <InputError
                        class="mt-2"
                        :message="form.errors.akses_dokumen"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Dokumen</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" accept="application/pdf, application/msword"
                            @input="form.patch_dokumen = $event.target.files[0]" id="exampleInputFile" />
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
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: -195px">
                  <button type="submit" class="btn btn-primary mr-2">
                    Simpan
                  </button>

                  <button class="btn btn-danger mr-2" type="reset">
                    Batal
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
                    <i class="fas fa-cubes" style="margin-left: -10px; margin-rigth: 5px"></i>
                    Detail Upload LKPS
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
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
                          Nama Lembaga
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Dokumen
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Tanggal Pengajuan
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Tanggal Penilaian
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Dokumen
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                        Akses Dokumen
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nilai LKPS
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, x) in DataLkps" :key="d">
                        <td style="text-align: center; vertical-align: middle">
                          {{ x + 1 }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.lembaga_unuja.nama_lembaga }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.nama_dokumen }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">{{ dateFormat(d.tgl_pengajuan) }}</td>
                        <td style="text-align: center; vertical-align: middle">
                          <span v-if="d.tgl_penilaian == NULL" class="text-danger">Belum di Nilai</span>
                          <span v-else>{{ dateFormat(d.tgl_penilaian) }}</span>
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <a :href="`/storage/${d.patch_dokumen}`" target="_blank" class="btn btn-sm btn-warning"><i
                              class="fas fa-eye"></i> Show Dokumen</a>
                        </td>
                        <td  style="text-align: center; vertical-align: middle;">
                          <div v-if="d.akses_dokumen == 'bisa'">
                            <Link
                              :href="`/upload-berkas-lkps-prodi/RMslre3M9qEym${d.id_pengajuan_lkps}4WBRLv4AoZ/update_akses`"
                              ><img src="@/Assets/on.png" />
                            </Link>
                          </div>
                          <div v-else>
                            <Link
                              :href="`/upload-berkas-lkps-prodi/RMslre3M9qEym${d.id_pengajuan_lkps}4WBRLv4AoZ/update_akses`"
                              ><img src="@/Assets/off.png" />
                            </Link>
                          </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <span v-if="d.nilai_lkps == NULL" class="text-danger">Belum di Nilai</span>
                          <span v-else>{{ d.nilai_lkps }}</span>
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
