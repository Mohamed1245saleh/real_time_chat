<template>
  <div class="vld-parent col-lg-12">
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    ></loading>
    <h1>My Rooms ({{ rooms.length }})</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>Delete Room</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(room, index) in rooms" :key="room.id">
          <td scope="row">
            <router-link :to="{ name: 'chatBox', params: { room_id: room.id , room_name: room.name} }">{{
              room.name
            }}</router-link>
          </td>
          <td>{{ room.created_at | moment("from", "now") }}</td>
          <td>
            <button
              class="btn btn-danger"
              @click.prevent="deleteRoom(index, room.id)"
            >
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
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
      this.$http.get("/getMyRooms").then((response) => {
        response = response.body;
        instance.rooms = response;
      });
      this.isLoading = false;
    },
    deleteRoom: function (index, room_id) {
      this.isLoading = true;
      this.$http.get("/deleteCurrentRoom/" + room_id).then((response) => {
        if (response.status) {
          this.rooms.splice(index, 1);
          console.log(response);
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
    },
  },
};
</script>