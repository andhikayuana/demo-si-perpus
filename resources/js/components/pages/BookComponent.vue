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
      title: "Buku",
      url: BASE_URL_API + "books",
      columns: [
        {
          label: "ID",
          name: "id",
        },
        {
          label: "Kategori",
          name: "category.name",
        },
        {
          label: "Judul",
          name: "title",
        },
        {
          label: "Total",
          name: "total",
        },
      ],
      forms: [
        {
          label: "Kategori",
          name: "book_categories_id",
          type: "dropdown",
        },
        {
          label: "Judul",
          name: "title",
          type: "text",
        },
        {
          label: "Deskripsi",
          name: "description",
          type: "textarea",
        },
        {
          label: "Jumlah Buku",
          name: "total",
          type: "number",
        },
      ],
    };
  },
  methods: {
    onDropdownSearch(obj) {
      axios
        .get(BASE_URL_API + "book-categories?name=" + obj.q)
        .then((response) => {
          console.log(response);
          const options = response.data.data.map((item) => {
            item.label = item.name;
            return item;
          });
          this.$emit("on-dropdown-options-updated", options);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
};
</script>

<style>
</style>