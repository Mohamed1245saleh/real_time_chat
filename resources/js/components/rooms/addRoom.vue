<template>
  <div class="vld-parent col-lg-12">
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    ></loading>
    <h1>Add Room</h1>
    <div class="form-group">
      <label for="Add Room"></label>
      <input
        type="text"
        class="form-control"
        name=""
        id=""
        v-model="inputValue"
        aria-describedby="helpId"
        placeholder=""
      />
    </div>
    <div class="form-group">
      <button
        type="submit"
        @click.prevent="doAjax"
        class="btn btn-primary"
        :disabled="btnSubmit"
        showalert="HelloWorld"
      >
        Submit
      </button>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import MessageBox from "vue-msgbox/src";
require("vue-msgbox/lib/vue-msgbox.css");

export default {
  data() {
    return {
      isLoading: false,
      fullPage: true,
      inputValue: "",
    };
  },
  components: {
    Loading,
  },
  computed: {
    btnSubmit: function () {
      if (this.inputValue == "") {
        return true;
      } else if (this.inputValue.length < 5) {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    doAjax() {
      this.isLoading = true;
      this.$http
        .post("/AddNewRoom", { name: this.inputValue })
        .then((response) => {
          //on success

          if (response.status) {
            MessageBox({
              title: response.body.title,
              message: response.body.message,
              type: "success",
              showCancelButton: false,
              confirmButtonPosition: "Left",
            }).then((action) => {
              if (action) {
                this.isLoading = false;
              }
            });
          } else {
            MessageBox({
              title: response.body.title,
              message: response.body.message,
              type: "error",
              showCancelButton: false,
              confirmButtonPosition: "Left",
            }).then((action) => {
              if (action) {
                this.isLoading = false;
              }
            });
          }
        });
      this.inputValue = "";
    },
    onCancel() {
      console.log("User cancelled the loader.");
    },
  },
};
</script>