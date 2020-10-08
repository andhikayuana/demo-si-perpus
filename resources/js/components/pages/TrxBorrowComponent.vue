<template>
  <div>
    <table-component
      :url="url"
      :columns="columns"
      :title="title"
      :forms="forms"
      @on-dropdown-search="onDropdownSearch"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Peminjaman Buku",
      url: BASE_URL_API + "trx-borrows",
      columns: [
        {
          label: "ID",
          name: "id",
        },
        {
          label: "Anggota",
          name: "member.name",
        },
        {
          label: "Tanggal Pinjam",
          name: "borrowed_at",
        },
        {
          label: "Jatuh Tempo",
          name: "due_return_at",
        },
      ],
      forms: [
        {
          label: "Anggota",
          name: "members_id",
          type: "dropdown",
        },
        {
          label: "Tanggal Pinjam",
          name: "borrowed_at",
          type: "date",
        },
        {
          label: "Jatuh Tempo",
          name: "due_return_at",
          type: "date",
        },
        {
          label: "Pinjam buku apa?",
          name: "books",
          type: "multiple_select",
        },
      ],
    };
  },
  methods: {
    onDropdownSearch(obj) {
      if (obj.formName == 'members_id') {
        this.onSearchMembers(obj);
      } else if (obj.formName == 'books') {
        this.onSearchBooks(obj);
      } else {
        alert('not supported');
      }
    },
    onSearchMembers(obj) {
      axios
        .get(BASE_URL_API + "members?name=" + obj.q)
        .then((response) => {
          console.log(response);
          const options = response.data.data.map((item) => {
            item.label = item.name;
            return item;
          });
          this.$emit("on-dropdown-options-updated", {
            formName: obj.formName,
            options: options,
          });
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    onSearchBooks(obj) {
      axios
        .get(BASE_URL_API + "books?name=" + obj.q)
        .then((response) => {
          console.log(response);
          const options = response.data.data.map((item) => {
            item.label = item.title;
            return item;
          });
          this.$emit("on-dropdown-options-updated", {
            formName: obj.formName,
            options: options,
          });
        })
        .catch((err) => {
          console.log(err.response);
        });
    }
  },
};
</script>

<style>
</style>