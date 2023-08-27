<template>
  <div class="row">
    <div class="col-auto">
      <img
        src="@/assets/profil.png"
        alt="Profil"
        class="img-circle elevation-2"
        style="width: 50px; vertical-align: middle;"
      />
    </div>
    <div class="col ml-1">
      <div class="row">
        <span class="brand-text font-weight-light" style="font-size: 15px"
          >Selamat Datang,</span
        >
      </div>
      <div class="row">
        <span class="brand-text font-weight-light text-wrap" style="font-size: 18px"
          ><b>{{ $page.props.auth.user.nama_lembaga }}</b></span
        >
      </div>
    </div>
  </div>
</template>