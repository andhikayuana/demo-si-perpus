<template>
  <div>
    <h3>{{ title }}</h3>
    <br />
    <button class="btn btn-primary" @click="onClickedAdd">Tambah</button>
    <br />
    <br />
    <table class="table table-striped">
      <thead>
        <tr>
          <th v-for="(column, index) in columns" :key="index" scope="col">
            {{ column.label }}
          </th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in response.data" :key="item.id">
          <td v-for="(column, index) in columns" :key="index">
            {{ getValueFrom(item, column) }}
          </td>
          <td>
            <button class="btn btn-primary" @click="onClickedEdit(item)">
              Ubah
            </button>
            <button class="btn btn-danger" @click="onClickedDelete(item)">
              Hapus
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <form-component 
        :title="title" 
        :url="url" 
        :forms="forms"
        @on-saved="onSaved">
    </form-component>
  </div>
</template>

<script>
export default {
  props: ["title", "url", "columns", "forms"],
  data() {
    return {
      response: {
        current_page: 1,
        data: [],
        first_page_url: null,
        from: null,
        last_page: 0,
        last_page_url: null,
        next_page_url: null,
        path: null,
        per_page: null,
        prev_page_url: null,
        to: null,
        total: 0,
      },
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios
        .get(this.url)
        .then((response) => {
          this.response = response.data;
          console.log(response);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getValueFrom(item, column) {
      let value;
      let handle = column.name.split(".");
      if (handle.length > 1) {
        value = item[handle[0]];
        for (let i = 1; i < handle.length; i++) {
          value = value[handle[i]];
        }
      } else {
        value = item[column.name];
      }

      return value;
    },
    onClickedEdit(item) {
      $('#formModal').modal('show');
    },
    onClickedDelete(item) {
      if (confirm("Hapus data dengan id : " + item.id)) {
        axios.delete(this.url+'/'+item.id)
            .then(response => {
                this.fetchData();
            })
            .catch(err => {
                console.log(err);
                alert(err.message);
            });
      }
    },
    onClickedAdd() {
      $('#formModal').modal('show');
    },
    onSaved(data) {
        this.fetchData();
    }
  }
};
</script>

<style>
</style>