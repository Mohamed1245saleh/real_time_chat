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
    <!-- <emoji></emoji> -->
    <div class="send_message">
      <!-- <div class="icon"></div> -->

      <div class="text" @click="sendNewMessage()">Send</div>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import * as PusherPushNotifications from "@pusher/push-notifications-web";
import MessageBox from "vue-msgbox/src";
// import emoji from './emoji.vue';
require("vue-msgbox/lib/vue-msgbox.css");
export default {
  data: function () {
    return {
      body: "",
    };
  },components:{
    //  emoji: emoji
  },
  methods: {
    sendNewMessage: function () {
      if(this.$route.params.room_id != undefined){
this.$http
        .post("/AddNewMessage", {
          body: this.body,
          room_id: this.$route.params.room_id,
        })
        .then((response) => {
          this.$emit("get-the-message", response.body.payload);
          this.body = "";
        });
      }else if(this.$route.params.sender_id && this.$route.params.receiver_id){
this.$http
        .post("/AddNewPrivateMessage", {
          body: this.body,
          sender_id: this.$route.params.sender_id,
          receiver_id: this.$route.params.receiver_id,
        })
        .then((response) => {
          console.log(response.body[0].name);
          // this.$emit("get-the-message", response.body.payload);
          this.body = "";
        });
      }

    },getNotification:function(){

      }
  },mounted(){
      this.getNotification();
    }
};
</script>
