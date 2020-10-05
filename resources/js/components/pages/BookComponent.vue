<template>
  <div>
    <table-component :url="url" :columns="columns" :title="title" />
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
          name: "id"
        },
        {
          label: "Kategori",
          name: "category.name"
        },
        {
          label: "Judul",
          name: "title"
        },
        {
          label: "Total",
          name: "total"
        }
      ]
    };
  },
};
</script>

<style>
</style>