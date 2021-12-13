<template>
  <div class="vld-parent col-lg-12">
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    ></loading>
    <h1>All Rooms ({{rooms.length}})</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>user</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for='room in rooms' :key="room.id" >
         <td> <router-link :to="{ name: 'chatBox', params: { room_id: room.id , room_name: room.name} }">{{
              room.name
            }}</router-link></td>
          <td>{{ room.created_at | moment("from", "now")}}</td>
          <td>{{room.users.name}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
    import Loading from "vue-loading-overlay";
    import "vue-loading-overlay/dist/vue-loading.css";
export default {

    
  data: function () {
    return {
      rooms: [],
      isLoading: true,
      fullPage: true,
    };
  },
  components: {
    Loading,
  },
  mounted() {
    this.getAllRooms();
    console.log("Function has been Created");
  },
  methods: {
    getAllRooms: function () {
        var instance = this;
      this.$http.get("/getAllRooms").then((response) => {
        response = response.body;
        instance.rooms = response;
      });
      this.isLoading = false;
    },
   },
   
};
</script>