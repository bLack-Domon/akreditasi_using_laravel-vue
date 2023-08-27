<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { computed } from "vue";

const props = defineProps({
  data: Object,
  lembaga_akreditasi: Object,
  lembaga_unuja: Object,
});

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const form = useForm({
  id_lembaga_akreditasi: props.data.id_lembaga_akreditasi,
  id_lembaga: props.data.id_lembaga,
  tgl_pengajuan: props.data.tgl_pengajuan,
  status: props.data.status,
  create_by: props.data.create_by,
  update_by: props.data.update_by,
  delete_by: user,
});
</script>

<template>
  <Head title="Edit Status Pengajuan Akreditasi" />

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
              <span class="ml-2 text-red" v-if="data.status == 'a'">
                <b>
                  Apakah Anda Yakin Ingin Menonaktifkan Pengajuan Akreditasi
                  Ini?
                </b>
              </span>
              <span class="ml-2 text-red" v-else>
                <b>
                  Apakah Anda Yakin Ingin Mengaktifkan Pengajuan Akreditasi Ini?
                </b>
              </span>
            </h3>
          </div>
          <form
            class="form-horizontal"
            @submit.prevent="
              form.post(
                `/pengajuan-akreditasi/${data.id_pengajuan}/update_status`
              )
            "
          >
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
                        disabled
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
                      <select
                        v-model="form.id_lembaga"
                        class="form-control"
                        onChange="{onHandleChange}"
                        disabled
                      >
                        <option
                          v-for="lu in lembaga_unuja"
                          :key="lu"
                          :value="`${lu.id_lembaga}`"
                        >
                          {{ lu.nama_lembaga }}
                        </option>
                      </select>
                      <InputError
                        class="mt-2"
                        :message="form.errors.id_lembaga"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4">Tanggal Pengisian</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <input
                        type="date"
                        class="form-control"
                        disabled
                        v-model="form.tgl_pengajuan"
                      />

                      <InputError
                        class="mt-2"
                        :message="form.errors.tgl_pengajuan"
                      />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4">Status (Aktif/Tidak Aktif)</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-7">
                      <div v-if="data.status == 'a'">
                        <input
                          value="Aktif"
                          disabled
                          type="text"
                          class="form-control"
                        />
                      </div>
                      <div v-else>
                        <input
                          value="Tidak Aktif"
                          disabled
                          type="text"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="form-group row" style="margin-left: -75px">
                  <button class="btn btn-primary mr-2">Ya</button>
                  <Link
                    :href="`/pengajuan-akreditasi`"
                    class="btn btn-danger mr-2"
                  >
                    Tidak
                  </Link>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
  </AdminLayout>
</template>
