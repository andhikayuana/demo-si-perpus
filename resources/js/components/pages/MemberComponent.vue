<template>
  <div>
    <table-component :url="url" :columns="columns" :title="title" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Anggota",
      url: BASE_URL_API + "members",
      columns: [
        {
          label: "ID",
          name: "id"
        },
        {
          label: "Nama",
          name: "name"
        },
        {
          label: "Nomor HP",
          name: "phone"
        },
        {
          label: "Alamat",
          name: "address"
        }
      ],
    };
  },
};
</script>

<style>
</style>