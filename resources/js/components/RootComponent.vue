<template>
  <div>
    <main-page v-if="token !== null"></main-page>
    <login-page :setToken="setToken" v-else></login-page>
  </div>
</template>

<script>
import LoginPage from "./LoginComponent";
import MainPage from "./MainComponent";

export default {
  data() {
    return {
      token: null,
    };
  },
  components: {
    LoginPage,
    MainPage,
  },
  mounted() {
    let token =
      localStorage.getItem("token") || sessionStorage.getItem("token");

    if (token !== null) {
      this.setToken(token);
    }
  },
  methods: {
    setToken(token) {
      this.token = token;

      window.axios.defaults.headers.common = {
        Authorization: `Bearer ${token}`,
      };
    },
  },
};
</script>
