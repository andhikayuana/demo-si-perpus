<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ header }}</div>

          <div class="card-body">
            {{ body }}
          </div>

          <div class="card-footer">
            <button class="btn btn-primary" @click="onLogoutClicked">
              Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import auth from '../../helpers/auth';
export default {
  props: ['header', 'body'],
  mounted() {
    console.log('Component mounted.');
  },
  methods: {
    onLogoutClicked() {
      if (confirm("keluar dari sistem ?")) {
        axios.post(BASE_URL_API + 'auth/logout', null)
            .then(response => {
                auth.clear();
                this.$router.push({ name: "login" });
            })
            .catch(err => {
                console.log(err);
                alert(err.message);
            });
      }
    },
  },
};
</script>
