<template>
  <div>
    <div
      class="modal fade"
      id="formModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="formModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">{{ title }}</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div
              class="alert alert-danger alert-dismissible fade show"
              role="alert"
              v-if="hasError"
            >
              {{ errorMessage }}
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
                @click="resetForm"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formMain" @submit.prevent="onClickedSave">
              <div
                class="form-group"
                v-for="(form, index) in forms"
                :key="index"
              >
                <label :for="form.name">{{ form.label }}</label>
                <input
                  type="text"
                  class="form-control"
                  :id="form.name"
                  :placeholder="form.label"
                  v-model="body[form.name]"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Batal
            </button>
            <button
              @click="onClickedSave"
              type="button"
              class="btn btn-primary"
            >
              Simpan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "url", "forms"],
  mounted() {
    const that = this;
    $("#formModal").on("hidden.bs.modal", function (e) {
      that.resetForm();
    });

    this.$parent.$on("on-edit", (item) => {
      this.body = item;
    });
  },
  data() {
    return {
      body: {},
      errorMessage: null,
    };
  },
  methods: {
    onClickedSave() {
      if (!this.hasError) {
        console.log(this.isNewRecord);
        const request = this.isNewRecord
          ? axios.post(this.url, this.body)
          : axios.put(this.url+'/'+this.body.id, this.body);

        request
          .then((response) => {
            $("#formModal").modal("hide");
            this.$emit("on-saved", response.data);
          })
          .catch((err) => {
            console.log(err.response.data);
            this.errorMessage = err.response.data.message;
          });
      }
    },
    resetForm() {
      this.body = {};
      this.errorMessage = null;
    },
  },
  computed: {
    hasError() {
      return this.errorMessage != null;
    },
    isNewRecord() {
      return !this.body.hasOwnProperty("id");
    },
  },
};
</script>

<style>
</style>