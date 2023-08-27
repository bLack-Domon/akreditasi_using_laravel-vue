<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import KaprodiLayout from "@/Layouts/KaprodiLayout.vue";
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
  update_by: user,
});

</script>

<template>
  <Head title="Edit Pengajuan Akreditasi" />

  <KaprodiLayout>
    <div class="row justify-content-center">
      <section class="col-lg-8 mt-3 connectedSortable">
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
              Edit Pengajuan Akreditasi
            </h3>
          </div>
          <form class="form-horizontal" @submit.prevent="form.put(`/pengajuan-akreditasi-prodi/${data.id_pengajuan}`)">
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
                <div class="form-group row" style="margin-left: 5px">
                  <button class="btn btn-primary btn-sm mr-2">Ubah</button>
                  <Link
                    :href="`/pengajuan-akreditasi-prodi`"
                    class="btn btn-danger btn-sm mr-2"
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
  </KaprodiLayout>
</template>