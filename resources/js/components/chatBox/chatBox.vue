<template>
  <div class="row">
    <ul class="tabs" style="">
        <li>
          <a href="#" rel="#tab_1_contents" class="tab">online users</a>
        </li>
        <li><a href="#" rel="#tab_2_contents" class="tab">Private Message</a></li>
      </ul>
      <!-- <div class="clear"></div> -->

      <div class="tab_contents_container">

        <!-- Tab 1 Contents -->
        <span id="tab_1_contents" class="tab_contents tab_contents_active">
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
    </span>

        <!-- Tab 2 Contents -->
        <span id="tab_2_contents" class="tab_contents">
          <div class="col-md-2">
          <aside class="sm-side" style="background-color:#003b57;">
        <div class="receiverUser">{{receiverUserName}}</div><i class="fa-solid fa-square-xmark"></i>
      </aside>
          </div>
      </span>
        </div>

    <div class="col-md-10" id="chatBox">
      <div class="chat_window">
        <div class="top_menu">
          <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
          </div>
          <div class="title">
            {{ room_name }}| Online Users ({{ whoIsOnlineLength }})
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
<style scoped>
@keyframes NavBarAnimation {
  from {background-color: gray;}
  to {background-color: navy;}

}
.receiverUser{
  width: 100px;
line-height: 35px;
text-align: left;
font-size: 20px;
color: white;
}
ul.tabs {
  display: flex;
    color: #666;
    /* text-align: center; */
    padding: 14px 16px;
    text-decoration: none;
}
ul.tabs li{
  border : 1px solid navy;
  border-bottom: none;
  margin:3px;
  line-height: 35px;
  font-size: 20px;
  border-radius: 14px;

}
ul.tabs li:hover{
animation-name: NavBarAnimation;
  animation-duration: 1s;
  animation-iteration-count: infinite;
}
ul.tabs a{
  color:gray;
  text-decoration: none;
}
</style>
<script>
import addMessage from "./addMessage.vue";
import getMessage from "./getMessage.vue";
import Activity from "./activity.vue";
import who_is_online from "./whoIsOnline.vue";
import $ from 'jquery';


export default {
  beforeRouteLeave(to, from, next) {
    var instance = this;
      this.$http.get("/leavingCurrentRoom/" + instance.room_id).then((response) => {
      if(response.body > 0){
            return next();
        }
      });
    },
  data: function () {
    return {
      message: [],
      uniqueIds: [],
      whoisOnline: [],
      repeatedOnlineUsers: [],
      room_name: this.$route.params.room_name,
      room_id: this.$route.params.room_id,
      whoIsOnlineLength: 0,
      recievedActivityMessage:[],
      activity:"activity",
      authencticatedUser: this.$authenticatedUser.id,
      receiverData:""
    };
  },

  components: {
    add_message: addMessage,
    get_message: getMessage,
    activity: Activity,
    who_is_online: who_is_online,

  },
  computed:{
     receiverUserName(){
       if(this.$store.state.privateChatReceiverUser != ""){
            return this.$store.state.privateChatReceiverUser.payload[0].name;
       }
     }
  },
  methods: {
    onInput(event) {
          //event.data contains the value of the textarea
      },
      clearTextarea(){
        this.$refs.emoji.clear()
      },
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
    whoIsOnline: function () {
      var instance = this;
      this.$http.get("/whoisonline/" + instance.room_id).then((response) => {

      });
    },
    bindEvents: function (event, channelName , callBackFucntion) {
      Pusher.logToConsole = true;
      var pusher = new Pusher("19ef4130d77bd9878839", {
        cluster: "mt1",
      });

      var channel = pusher.subscribe(channelName);
      channel.bind(event, (data)=>{
        callBackFucntion(data);
      });
    },
     updateOnlineCounts(data) {
       var instance = this;
      if (instance.repeatedOnlineUsers.indexOf(data.users.id) === -1) {
          instance.repeatedOnlineUsers.push(data.users.id);
          instance.whoIsOnlineLength = data.message;
          instance.whoisOnline = data.users;
          instance.recievedActivityMessage.push(data.activityMessage);
          // alert(instance.recievedActivityMessage);
        };
        instance.repeatedOnlineUsers = [];
    },leavingUsers(data){
      // console.log(data);
      var instance = this;
       instance.whoIsOnlineLength = data.message;
       instance.recievedActivityMessage.push(data.activityMessage);
    },naviagtingTabs(){
      // console.log(this.$store.state.privateChatReceiverUser);
      $('.tab_contents').show();
      $('#tab_2_contents').hide();

  $('.tab').click(function(event) {
    event.preventDefault();
     var target = $(this.rel);
        $('.tab_contents').not(target).hide();
        target.show();
  $('#tabs_container > .tabs > li.active')
      .removeClass('active');

  $(this).parent().addClass('active');

  $('#tabs_container > .tab_contents_container > div.tab_contents_active')
      .removeClass('tab_conttab_contentsents_active');

  $(this.rel).addClass('tab_contents_active');
 });



  }
  },
  mounted() {

    this.bindEvents("onlineUsersPerRoom" , this.room_id + "onlineUser" , this.updateOnlineCounts);
    this.bindEvents("newMessage" , this.room_id + "room" , this.getTheSentMessageBack);
    this.whoIsOnline();
    this.bindEvents("offlineUsersPerRoom", this.room_id + "offlineUser" , this.leavingUsers);
    this.naviagtingTabs();

  }
};
</script>
