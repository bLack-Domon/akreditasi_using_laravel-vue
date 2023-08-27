<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user.nama_lembaga);

const props = defineProps({
  data: Object,
  lembaga_akreditasi: Object,
});

const form = useForm({
  //form untuk input data
  id_lembaga_akreditasi: props.data.id_lembaga_akreditasi,
  nama_bab: props.data.nama_bab,
  deskripsi_bab: props.data.deskripsi_bab,
  create_by: props.data.create_by,
  update_by: user,
});
</script>

<template>
  <Head title="Data Jenis BAB" />

  <AdminLayout>
    <div class="row">
      <section class="col-lg-12 mt-3 connectedSortable">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">
              <i
                class="fas fa-cubes"
                style="margin-left: -10px; margin-rigth: 5px"
              ></i>
              Edit Data BAB
            </h3>
          </div>
          <form
            class="form-horizontal"
            @submit.prevent="form.put(`/data-jenis-bab/${data.id_bab}`)"
          >
            <div class="card-body">
              <div class="row justify-content-center">
                <input
                  type="hidden"
                  class="form-control mb-2"
                  id="update_by"
                  v-model="form.update_by"
                />
                <input
                  type="hidden"
                  class="form-control mb-2"
                  id="create_by"
                  v-model="form.create_by"
                />
                <div class="col-lg-7">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"
                      >Lembaga Akreditasi</label
                    >
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
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
                    <label class="col-sm-3 col-form-label">Nama BAB</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.nama_bab"
                        placeholder="Nama BAB"
                      />
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.nama_bab"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-auto" style="margin-top: 6px">:</div>
                    <div class="col-sm-8">
                      <textarea
                        v-model="form.deskripsi_bab"
                        cols="30"
                        rows="5"
                        class="form-control"
                      ></textarea>
                      
                      <InputError
                        class="mt-2"
                        :message="form.errors.deskripsi_bab"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-1">
                <div class="form-group row" style="margin-left: 0px">
                  <button type="submit" class="btn btn-primary mr-2">
                    Update
                  </button>
                  <Link :href="`/data-jenis-bab`" class="btn btn-danger mr-2">
                    Batal
                  </Link>
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
                    Detail Data BAB
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
                  <table class="table table-striped table-bordered">
                    <tr>
                      <th>No</th>
                      <th>Nama BAB</th>
                      <th>Deskripsi</th>
                      <th>Proses</th>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </AdminLayout>
</template>
