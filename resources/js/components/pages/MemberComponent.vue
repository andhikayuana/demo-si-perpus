<template>
  <div>
    <table-component :url="url" :columns="columns" :title="title" :forms="forms" />
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
      forms: [
        {
          label: 'Nama',
          name: 'name',
          type: 'text'
        },
        {
          label: 'Nomor HP',
          name: 'phone',
          type: 'text'
        },
        {
          label: 'Alamat',
          name: 'address',
          type: 'textarea'
        }
      ]
    };
  },
};
</script>

<style>
</style>