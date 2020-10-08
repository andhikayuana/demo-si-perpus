<template>
  <div>
    <table-component
      :url="url"
      :columns="columns"
      :title="title"
      :forms="forms"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Pengembalian Buku",
      url: BASE_URL_API + "trx-returns",
      columns: [
        {
          label: "ID",
          name: "id",
        },
        {
          label: "Anggota",
          name: "trx_borrow.member.name",
        },
      ],
    };
  },
};
</script>

<style>
</style>