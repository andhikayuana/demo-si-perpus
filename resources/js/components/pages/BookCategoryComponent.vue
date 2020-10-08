<template>
  <div>
    <table-component :url="url" :columns="columns" :title="title" :forms="forms"/>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Kategori Buku",
      url: BASE_URL_API + "book-categories",
      columns: [
        {
          label: "ID",
          name: "id"
        },
        {
          label: "Nama",
          name: "name"
        }
      ],
      forms: [
        {
          label: 'Nama',
          name: 'name',
          type: 'text'
        }
      ]
    };
  }
};
</script>

<style>
</style>