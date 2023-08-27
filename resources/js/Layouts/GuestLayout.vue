<style scoped>
hr {
    margin: 0px;
    border: none;
    height: 2px;
    width: 600px;
    /* Set the hr color */
    color: #333;
    /* old IE */
    background-color: #333;
    /* Modern Browsers */
}
</style>

<template>
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="mt-3 ml-3" style="width:120px;">
                <img src="@/assets/logo.png" alt="" width="100px;">
            </div>
    
            <div style="margin-top: 40px; width: 650px; font-size: 20px;">
                <h3>Aplikasi Pengajuan Akreditasi di Universitas Nurul Jadid</h3>
                <h5><i class="far fa-copyright"></i> TIM IT Fakultas Teknik 2023</h5>
            </div>
        </div>
    </div>
    <hr>
    <div class="container" style="margin-top:30px;">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-light border-dark mb-3">
                    <div class="card-body text-dark p-3">
                        <slot/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
