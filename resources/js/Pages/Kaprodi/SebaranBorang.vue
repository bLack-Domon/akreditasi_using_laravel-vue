<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
import InputError from "@/Components/InputError.vue";
import { computed } from "vue";
import moment from "moment";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs4";

DataTable.use(DataTablesCore);

defineProps({
  PengajuanAkreditasi: Object,
  lembaga_akreditasi: Object,
  lembaga_unuja: Object,
});

const page = usePage();
const user_id = computed(() => page.props.auth.user.id_lembaga);
const user = computed(() => page.props.auth.user.nama_lembaga);

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

const form = useForm({
  id_lembaga_akreditasi: "",
  id_lembaga: user_id,
  tgl_pengajuan: "",
  create_by: user,
});

const submit = () => {
  form.post(route("pengajuan-akreditasi-prodi.store"), {
    preserveScroll: true,
    onSuccess: () => setTimeout(function () {
      window.location.reload();
    }, 500)
  })
};
</script>

<template>
  <Head title="Sebaran Pengisian Borang" />

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
              Pengajuan Akreditasi - {{ user }}
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="submit">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="form-group row">
                    <label class="col-sm-4" for="">Lembaga Akreditasi</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <select
                        v-model="form.id_lembaga_akreditasi"
                        class="form-control"
                        onChange="{onHandleChange}"
                      >
                        <option
                          v-for="la in lembaga_akreditasi"
                          :key="la"
                          :value="`${la.id_lembaga_akreditasi}`"
                        >
                          {{ la.nama_lembaga }}
                        </option>
                      </select>
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_lembaga_akreditasi"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4">Lembaga Unuja</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input type="text" :value="`${user}`" disabled class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4">Tanggal Pengisian</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        type="date"
                        class="form-control"
                        v-model="form.tgl_pengajuan"
                      />

                      <InputError
                        class="mt-2"
                        :message="form.errors.tgl_pengajuan"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="form-group row" style="margin-left: -45px">
                  <button class="btn btn-primary mr-2">Simpan</button>
                  <button class="btn btn-danger" type="reset">Batal</button>
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
                    Data Pengajuan Akreditasi
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
                          Nama Lembaga Unuja
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Tanggal Pengajuan
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Nama Lembaga Akreditasi
                        </th>
                        <th style="text-align: center; vertical-align: middle">
                          Detail
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(d, index) in PengajuanAkreditasi" :key="d">
                        <td style="text-align: center; vertical-align: middle">
                          {{ index + 1 }}
                        </td>
                        <td style="vertical-align: middle">
                          {{ d.lembaga_unuja.nama_lembaga }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          {{ dateFormat(d.tgl_pengajuan) }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          {{ d.lembaga_akreditasi.nama_lembaga }}
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <Link
                            :href="`/pengajuan-akreditasi-prodi/Zdo9k1lysUiwHuKn${d.id_pengajuan}Dxs2oXPIGi/detail`"
                            class="btn btn-sm btn-success mr-1"
                            >Sebaran
                          </Link>
                          <Link
                            :href="`/pengajuan-akreditasi-prodi/${d.id_pengajuan}/edit`"
                            class="btn btn-sm btn-danger mr-1"
                            ><i class="fas fa-pen-square mt-1 mr-1"></i> Edit
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