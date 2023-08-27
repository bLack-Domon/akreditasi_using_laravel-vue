<script setup>
import KaprodiLayout from '@/Layouts/KaprodiLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Sebaran Pengajuan Prodi" />

    <KaprodiLayout>
        <div class="row">
          <section class="col-lg-12 mt-3 connectedSortable">
            <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">
                  <i
                    class="fas fa-cubes"
                    style="margin-left: -10px; margin-rigth: 5px"
                  ></i>
                  Sebaran Pengajuan - {{ $page.props.auth.user.nama_lembaga }}
                </h3>
              </div>
            </div>
          </section>
        </div>
    </KaprodiLayout>
</template>
