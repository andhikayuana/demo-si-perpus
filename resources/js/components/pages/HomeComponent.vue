<template>
  <div>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <router-link class="navbar-brand col-sm-3 col-md-2 mr-0" to="/">{{
        header
      }}</router-link>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#" @click="onLogoutClicked">
            <b>({{ user.name }})</b> Logout
          </a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item" v-for="menu in sidebar" :key="menu.name">
                <router-link class="nav-link" :to="menu.path">{{
                  menu.name
                }}</router-link>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom"
            v-if="isHomePage"
          >
            <h3 v-if="isHomePage">Dashboard</h3>
          </div>
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import auth from "../../helpers/auth";
import sidebar from "../../helpers/sidebar";
export default {
  props: ["header", "body"],
  data() {
    return {
      sidebar: [],
      user: {},
    };
  },
  mounted() {
    this.sidebar = sidebar;
    this.user = auth.getUser();
  },
  methods: {
    onLogoutClicked() {
      if (confirm("keluar dari sistem ?")) {
        axios
          .post(BASE_URL_API + "auth/logout", null)
          .then((response) => {
            auth.clear();
            this.$router.push({ name: "login" });
          })
          .catch((err) => {
            console.log(err.response.data);
            alert(err.response.data.message);
          });
      }
    },
  },
  computed: {
    isHomePage() {
      return this.$route.name == "home";
    },
  },
};
</script>
