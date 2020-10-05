<template>
  <div class="container-fluid h-100 bg-light text-dark">
    <div class="row justify-content-center align-items-center">
      <h1>Login</h1>
    </div>
    <hr />
    <div class="row justify-content-center align-items-center h-100">
      <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <form id="formLogin">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="email"
              v-model="email"
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control"
              placeholder="password"
              v-model="password"
            />
          </div>
          <div class="form-group">
            <button
              @click="onClickBtnLogin"
              class="col-12 btn btn-primary btn-sm float-right"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import auth from '../../helpers/auth';
export default {
  data() {
    return {
      email: null,
      password: null,
    };
  },
  mounted() {
    console.log("login mounted");
  },
  methods: {
    onClickBtnLogin(e) {
      e.preventDefault();

      if (this.validate()) {
        const body = {
          email: this.email,
          password: this.password,
        };

        axios
          .post(BASE_URL_API + 'auth/login', body)
          .then((response) => {
            
            auth.saveToken(response.data.api_token);
            auth.saveUser(response.data);

            window.location.reload();
          })
          .catch((err) => {
            console.log(err.response.data);
            alert(err.response.data.message);
          });
      } else {
        alert('email & password harus diisi! silakan periksa kembali');
      }
    },
    validate() {
      if (this.email == null || this.email == '') {
        return false
      } 
      if (this.password == null || this.password == '') {
        return false
      } 

      return true;
    },
  },
};
</script>

<style>
</style>