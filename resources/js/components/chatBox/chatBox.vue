<template>
  <div class="col-md-12">
    <div class="row">
      <div class="col-lg-4">
        <button class="btn btn-info">
          <router-link to="/allrooms">All Rooms</router-link>
        </button>
      </div>
      <div class="col-lg-4">
        <button class="btn btn-dark">
          <router-link to="/myrooms">My Rooms</router-link>
        </button>
      </div>
    </div>
    <hr />
    <div class="chat_window">
      <div class="top_menu">
        <div class="buttons">
          <div class="button close"></div>
          <div class="button minimize"></div>
          <div class="button maximize"></div>
        </div>
        <div class="title">{{room_name}}| Online Users ({{whoIsOnlineLength}})</div>
      </div>
      <add_message :messages="message" ></add_message>
      <get_message @get-the-message="getTheSentMessageBack"></get_message>
    </div>
    <div class="message_template">
      <li class="message">
        <div class="avatar"></div>
        <div class="text_wrapper">
          <div class="text"></div>
        </div>
      </li>
    </div>
  </div>
</template>

<script>
import addMessage from "./addMessage.vue";
import getMessage from "./getMessage.vue";

export default {
  data: function () {
    return {
      message: [],
      uniqueIds: [],
      whoisOnline:[],
      room_name: this.$route.params.room_name,
      room_id:this.$route.params.room_id,
      whoIsOnlineLength:0
    };
  },

  components: {
    add_message: addMessage,
    get_message: getMessage,
  },
  methods: {
    getTheSentMessageBack: function () {
      this.bindEvents("newMessage" , this.room_id+"room");
    },whoIsOnline:function(){
      
      var instance = this;
      this.$http.get("/whoisonline/"+instance.room_id).then((response) => {
        // this.updateOnlineCounts();
        
      });
    },bindEvents:function(event , channelName){
      var instance = this;
      // Pusher.logToConsole = true;
      var pusher = new Pusher("19ef4130d77bd9878839", {
        cluster: "mt1",
      });

      var channel = pusher.subscribe(channelName);
      channel.bind(event, function (data) {
        if (!instance.uniqueIds.includes(data.messages.id) && data.messages.id != null) {
          instance.uniqueIds.push(data.messages.id);
          instance.message.push(data.messages);
        }
      });
    },updateOnlineCounts(){
      
      var instance = this;
      //  Pusher.logToConsole = true;
      var pusher = new Pusher("19ef4130d77bd9878839", {
        cluster: "mt1",
      });


      var channel1 = pusher.subscribe(instance.room_id+"onlineUser");
      channel1.bind("onlineUsersPerRoom", function (data) {
        instance.whoIsOnlineLength = data.message;
      });


      var channel2 = pusher.subscribe(instance.room_id+"offlineUser");
      channel2.bind("offlineUsersPerRoom", function (data) {
        // console.log(data);
        instance.whoIsOnlineLength = data.message;
      });
    }
  },
  mounted() {
    this.updateOnlineCounts();
    this.getTheSentMessageBack();
    this.whoIsOnline();
    
  },created(){
    this.updateOnlineCounts();
    this.whoIsOnline();  
  }
};
</script>