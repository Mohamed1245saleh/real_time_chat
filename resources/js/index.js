import Vue from 'vue'
// import chatBox from './components/chatBox/chatBox.vue'
import addRoom from './components/rooms/addRoom.vue'

new Vue({
    el: "#app",
    components: {
        // chat_box: chatBox,
        add_room: addRoom
    },
    data: function() {
        return {
            message: "Hello",
        }
    }

});