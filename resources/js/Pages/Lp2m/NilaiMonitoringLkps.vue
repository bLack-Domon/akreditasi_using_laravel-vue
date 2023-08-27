<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

const props = defineProps({
  Nilai: Object, //menampilkan data
});

const form = useForm({
  //form untuk input data
  id_lembaga: props.Nilai.id_lembaga,
  tgl_pengajuan: props.Nilai.tgl_pengajuan,
  patch_dokumen: props.Nilai.patch_dokumen,
  nilai_lkps: '',
  create_by: props.Nilai.create_by,
  status: props.Nilai.status,
  update_by: user,
});

</script>

<template>
  <Head title="Nilai Dokumen Monitoring LKPS" />

  <AdminLayout>
   <div class="row justify-content-center">
    <section class="col-lg-8 mt-3 connectedSortable">
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">
            <i
              class="fas fa-cubes"
              style="margin-left: -10px; margin-rigth: 5px"
            ></i>
            Nilai Dokumen Monitoring LKPS
          </h3>
        </div>
        <form
          class="form-horizontal"
          @submit.prevent="form.post(`/simpan-nilai-lkps/v29DJti4iyHwKAc${props.Nilai.id_pengajuan_lkps}JZHsEkxBLhdlX`)"
        >
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"
                    >Nama Lembaga</label
                  >
                  <div class="col-sm-auto" style="margin-top: 6px">:</div>
                  <div class="col-sm-7">
                   <input type="text" disabled class="form-control" :value="`${props.Nilai.lembaga_unuja.nama_lembaga}`">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Pengajuan</label>
                  <div class="col-sm-auto" style="margin-top: 6px">:</div>
                  <div class="col-sm-7">
                   <input type="text" disabled class="form-control" :value="`${ dateFormat(props.Nilai.tgl_pengajuan) }`">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nilai LKPS</label>
                  <div class="col-sm-auto" style="margin-top: 6px">:</div>
                  <div class="col-sm-7">
                   <input type="text" class="form-control" v-model="form.nilai_lkps" placeholder="Nilai dari 1-100">

                   <InputError
                     class="mt-2"
                     :message="form.errors.nilai_lkps"
                   />
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center mt-1">
              <div class="form-group row" style="margin-left: 35px">
                <button type="submit" class="btn btn-primary mr-2">
                  Simpan
                </button>
                <Link class="btn btn-danger" :href="route('monitoring-lkps.index')">Batal</Link>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
  </AdminLayout>
</template>