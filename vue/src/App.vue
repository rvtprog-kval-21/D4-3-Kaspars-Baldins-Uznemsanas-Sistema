<template>
    <div>
      <b-navbar toggleable="lg" type="dark" variant="dark">

        <b-navbar-brand href="#"><img src="/images/logo.webp" alt="Rīgas Valsts tehnikums" width="100%" id="logo"></b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav v-if="User">
            <b-nav-item :to="{ name: 'aktivadiena' }">Aktīvā diena</b-nav-item>
            <b-nav-item :to="{ name: 'visistudenti' }">Visi Studenti</b-nav-item>
            <b-nav-item :to="{ name: 'grupas' }" >Grupas</b-nav-item>
            <b-nav-item :to="{ name: 'specialitate' }" >Specialitātes</b-nav-item>
            <b-nav-item :to="{ name: 'statistika' }" >Statistika</b-nav-item>
<!--            <b-nav-item :to="{ name: 'eksports' }" >Eksports</b-nav-item>-->
          </b-navbar-nav>

        </b-collapse>
      </b-navbar>
      <router-view></router-view>
    </div>

</template>

<script>
import auth from '@/services/auth'
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters ({
      User: "Auth/user",
    })
  },
  created() {
    if (process.env.VUE_APP_CLIENT_ID) {
      auth.configure(process.env.VUE_APP_CLIENT_ID, false)
    } else {
      this.error = 'VUE_APP_CLIENT_ID is not set, the app will not function! 😥'
    }
  }
}
</script>

<style lang="scss">

body {
  width: 100%;
  height: 100%;
  background-image: url("/images/background.webp");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-attachment: fixed;
}
#logo {
  max-width: 40px;
}
nav.navbar.navbar-dark.navbar-expand-lg {
  padding: 0px;
}
.footer {
  position: fixed;
  bottom: 0;
  background-color: #343a40;
  width: 100%;
  height: 50px;
  margin-top: 70px;
  color: rgba(255,255,255,.5);
  text-align: right;
  padding-right: 20px;
  line-height: 50px;
}

</style>
