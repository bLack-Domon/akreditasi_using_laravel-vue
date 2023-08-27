<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import InputError from "@/Components/InputError.vue";
import moment from "moment";

function dateFormat(value) {
  return moment(value).format("DD-MM-YYYY");
}

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  pengajuan: Object
})

const form = useForm({
  id_pengajuan: props.pengajuan.id_pengajuan,
  nilai: '',
  create_by: user,
});
</script>

<template>
    <Head title="Nilai Pengajuan Akreditasi Prodi" />

    <AdminLayout>
        <div class="row justify-content-center">
            <section class="col-lg-8 mt-3 connectedSortable">
                <!-- table -->
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i
                                class="fas fa-cubes"
                                style="margin-left: -10px; margin-rigth: 5px"
                            ></i>
                            Penilaian Pengajuan Akreditasi Prodi
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
                    <form
                      class="form-horizontal"
                      @submit.prevent="form.post(`/nilai-monitoring-led/khygvbnTd45${props.pengajuan.id_pengajuan}PHgfrtCE4qw`)"
                    >
                    <div class="card-body">
                      <div class="row justify-content-center">
                        <div class="col-md-8">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group row">
                                <div class="col">
                                  <label>Nama Lembaga : </label>
                                </div>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" :value="`${props.pengajuan.create_by}`" disabled>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group row">
                                <div class="col">
                                  <label>Tanggal Pengajuan : </label>
                                </div>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" disabled :value="`${dateFormat(props.pengajuan.tgl_pengajuan)}`">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group row">
                                <div class="col">
                                  <label>Nilai : </label>
                                </div>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" v-model="form.nilai" placeholder="Nilai dari 1-100">

                                  <InputError
                                    class="mt-2"
                                    :message="form.errors.nilai"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="form-group row" style="margin-left: 78px">
                          <button class="btn btn-primary mr-2">Simpan</button>
                          <Link :href="route('monitoring-led.index')" class="btn btn-danger">Batal</Link>
                        </div>
                      </div>
                     </div>
                    </form>
                </div>
            </section>
        </div>
    </AdminLayout>
</template>
