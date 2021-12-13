<template>
  <div class="bottom_wrapper clearfix">
    <div class="message_input_wrapper">
      <input
        class="message_input"
        @keyup.enter.prevent="sendNewMessage()"
        v-model="body"
        placeholder="Type your message here..."
      />
    </div>
    <div class="send_message">
      <div class="icon"></div>
      <div class="text" @click="sendNewMessage()">Send</div>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import MessageBox from "vue-msgbox/src";
require("vue-msgbox/lib/vue-msgbox.css");
export default {
  data: function () {
    return {
      body: "",
    };
  },
  methods: {
    sendNewMessage: function () {
      this.$http
        .post("/AddNewMessage", {
          body: this.body,
          room_id: this.$route.params.room_id,
        })
        .then((response) => {
          this.$emit("get-the-message", response.body.payload);
          this.body = "";
        });
    },
  },
};
</script>