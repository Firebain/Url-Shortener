<template>
  <form class="form-signin" @submit.prevent="submit">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <div v-for="(error, key) in errors" :key="key" class="error">{{ error }}</div>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input
      type="email"
      v-model="formData.email"
      id="inputEmail"
      class="form-control"
      placeholder="Email address"
    />
    <label for="inputPassword" class="sr-only">Password</label>
    <input
      type="password"
      v-model="formData.password"
      id="inputPassword"
      class="form-control"
      placeholder="Password"
    />
    <div class="checkbox mb-3">
      <label>
        <input v-model="rememberMe" type="checkbox" value="remember-me" /> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  props: ["setToken"],
  data() {
    return {
      formData: {
        email: "",
        password: "",
      },
      rememberMe: false,
      errors: [],
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/login", { ...this.formData })
        .then((res) => {
          const token = res.data;

          const storage = this.rememberMe ? localStorage : sessionStorage;

          storage.setItem("token", token);

          this.setToken(token);
        })
        .catch((err) => {
          let errors = [];

          if (err.response?.status === 422) {
            let errorBag = err.response.data.errors;

            Object.keys(errorBag).forEach((key) =>
              errors.push(...errorBag[key])
            );
          } else {
            errors.push("Unexpected error");
          }

          this.errors = errors;
        });
    },
  },
};
</script>
