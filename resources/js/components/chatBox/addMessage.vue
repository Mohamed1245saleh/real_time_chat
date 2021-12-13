<template>
  <ul class="messages">
    <li
      v-if="message.body != ''"
      class="message left  appeared"
      v-for="message in messages"
      :key='message.id'
    >
      <div class="avatar">{{ message.users.name }}</div>
      <div class="text_wrapper">
        <div class="text">{{ message.body }}</div>
        <div class="text">
          <span class="far fa-clock" aria-hidden="true"></span>
          {{ message.created_at | moment("H:mm") }}
        </div>
      </div>
    </li>
  </ul>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import MessageBox from "vue-msgbox/src";
require("vue-msgbox/lib/vue-msgbox.css");
export default {
  props: ["messages"],
  data: function () {
    return {};
  },
};
</script>