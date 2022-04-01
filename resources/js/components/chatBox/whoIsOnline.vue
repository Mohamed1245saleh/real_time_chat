<template>
  <div >
    <ul class="list-group list-group-flush">
      <li  class="list-group-item" v-for="(user,index) in onlineUsers" :key="index" :id="user.id" v-if="authenticatedUser!=user.id" @click="createNewPrivateChat(authenticatedUser ,user.id)">
        <i class="fas fa-circle" style="color:green;margin-right:20px;"></i>
        <!-- <router-link :to="{ name: 'privatechatbox', params: { sender_id:authenticatedUser , receiver_id: user.id} }"> -->
              {{user.name}}
              
            <!-- </router-link> -->
        <br>
      </li>
    </ul>
  </div>
</template>

<style scoped>
li.list-group-item:hover{
  cursor: pointer;
}
</style>
<script>


export default {
  props:['onlineUsers' , 'authenticatedUser'],
  data: function () {
    return {
      sender_id:this.$authenticatedUser.id,
      receiver_id:"",
     
    };
  },computed:{
      reveiver_data(){
          return this.$store.state.privateChatReceiverUser;
   }
  }
  ,methods:{
     createNewPrivateChat: function(sender_id , receiver_id){
       var instance = this;
    instance.$router.push({name:"privatechatbox" ,params:{sender_id , receiver_id} });
     },bindEvents: function (event, channelName , callBackFucntion) {
      // Pusher.logToConsole = true;
      var pusher = new Pusher("19ef4130d77bd9878839", {
        cluster: "mt1",
      });

      var channel = pusher.subscribe(channelName);
      channel.bind(event, (data)=>{
        console.log(data);
        callBackFucntion(data);
      });
    },testfunction:function(data){
      console.log(data);
    }
  },
  mounted(){
    
  }
  

};
</script>