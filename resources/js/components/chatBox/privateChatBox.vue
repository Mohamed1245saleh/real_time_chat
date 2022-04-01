<template>
  <div class="row">
    <div class="col-md-2">
      <aside class="sm-side">
        <!-- <div class="inbox-body"> -->

        <who_is_online :onlineUsers="whoisOnline" :authenticatedUser="this.$authenticatedUser.id"></who_is_online>
        
        <Keep-alive>
        <component :recievedActivityMessage = "recievedActivityMessage" :is="activity" ></component>
        </Keep-alive>
        <!-- </div> -->
      </aside>
    </div>
    <div class="col-md-10">

      <div class="chat_window">
        <div class="top_menu">
          <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
          </div>
          <div class="title">
            {{ receiverName }}
          </div>
        </div>
        <add_message :messages="message"></add_message>
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
  </div>
</template>

<script>
import addMessage from "./addMessage.vue";
import getMessage from "./getMessage.vue";
import Activity from "./activity.vue";
import who_is_online from "./whoIsOnline.vue";



export default {
  data: function () {
    return {
      message: [],
      uniqueIds: [],
      whoisOnline: [],
      repeatedOnlineUsers: [],
      whoIsOnlineLength: 0,
      recievedActivityMessage:[],
      activity:"activity",
      authencticatedUser: this.$authenticatedUser.id,
      receiverUserData:this.$store.state.privateChatReceiverUser,
      receiverName:"",
    };
  },

  components: {
    add_message: addMessage,
    get_message: getMessage,
    activity: Activity,
    who_is_online: who_is_online,
    
  },
  computed:{
      reveiver_data(){
          return this.$store.state.privateChatReceiverUser;
   }
  },
  methods: {
    getTheSentMessageBack: function (data) {
      var instance = this;
      var data;
      if (
          !instance.uniqueIds.includes(data.messages.id) &&
          data.messages.id != null
        ) {
          instance.uniqueIds.push(data.messages.id);
          instance.message.push(data.messages);
        }
    },
    bindEvents: function (event, channelName , callBackFucntion) {
      // Pusher.logToConsole = true;
      var pusher = new Pusher("19ef4130d77bd9878839", {
        cluster: "mt1",
      });

      var channel = pusher.subscribe(channelName);
      channel.bind(event, (data)=>{
        callBackFucntion(data);
      });
    },
    createNewPrivateChat: function(){
       var instance = this;
       this.$http.post('/createNewPrivateChat', 
      {
        sender_id: this.$route.params.sender_id   , 
        receiver_id:this.$route.params.receiver_id
       }).then(response => {
       this.$store.state.privateChatReceiverUser = response.body;
       instance.receiverName = response.body.payload[0].name;
  }, response => {
    // error callback
  });
     }
  },
  mounted() {
    this.createNewPrivateChat();
    this.bindEvents("onlineUsersPerRoom" , this.room_id + "onlineUser" , this.updateOnlineCounts);
    this.bindEvents("newMessage" , this.room_id + "room" , this.getTheSentMessageBack);
    
    
  }
};
</script>