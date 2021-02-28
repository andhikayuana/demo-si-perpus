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
                @click="errorMessage = null"
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
                  v-if="form.type == 'number'"
                  type="number"
                  class="form-control"
                  :id="form.name"
                  :placeholder="form.label"
                  v-model="body[form.name]"
                />
                <input
                  v-else-if="form.type == 'date'"
                  type="date"
                  class="form-control"
                  :id="form.name"
                  :placeholder="form.label"
                  v-model="body[form.name]"
                />
                <textarea
                  v-else-if="form.type == 'textarea'"
                  class="form-control"
                  v-model="body[form.name]"
                  :id="form.name"
                ></textarea>
                <v-select
                  v-else-if="form.type == 'dropdown'"
                  :options="dropdownOptions[form.name]"
                  :reduce="(item) => item.id"
                  @search="
                    (search, loading) =>
                      onDropdownSearch(search, loading, form.name)
                  "
                  v-model="body[form.name]"
                ></v-select>
                <v-select
                  v-else-if="form.type == 'multiple_select'"
                  multiple
                  :options="dropdownOptions[form.name]"
                  :reduce="(item) => item.id"
                  @search="
                    (search, loading) =>
                      onDropdownSearch(search, loading, form.name)
                  "
                  v-model="body[form.name]"
                >
                </v-select>
                <input
                  v-else
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

    this.forms
      .filter(
        (form) => form.type == "dropdown" || form.type == "multiple_select"
      )
      .forEach((form) => {
        that.dropdownOptions[form.name] = [];
        that.body[form.name] = [];
      });

    this.$parent.$parent.$on("on-dropdown-options-updated", (obj) => {
      this.dropdownOptions[obj.formName] = _.uniqWith(
        this.dropdownOptions[obj.formName].concat(obj.options),
        _.isEqual
      );

      this.$forceUpdate();
    });
  },
  data() {
    return {
      body: {},
      errorMessage: null,
      dropdownOptions: {},
    };
  },
  methods: {
    onClickedSave() {
      if (!this.hasError) {
        const request = this.isNewRecord
          ? axios.post(this.url, this.body)
          : axios.put(this.url + "/" + this.body.id, this.body);

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
    onDropdownSearch(q, loading, formName) {
      this.$emit("on-dropdown-search", {
        q: q,
        loading: loading,
        formName: formName,
      });
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