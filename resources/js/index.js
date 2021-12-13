import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from "vue-resource"
import Pusher from "pusher-js"
Vue.use(VueRouter)
Vue.use(VueResource);
Vue.use(require('vue-moment'));
Vue.use(require('vue-pusher'), {
    api_key: '19ef4130d77bd9878839',
    // options: {
    //     cluster: 'mt1',
    //     encrypted: true,
    // }
});
import myRooms from './components/rooms/myRooms.vue'
import addRoom from './components/rooms/addRoom.vue'
import allRooms from './components/rooms/allRooms.vue'
import chatBox from './components/chatBox/chatBox.vue'

Vue.http.headers.common['X-CSRF-Token'] = document.getElementById("_token").getAttribute("value");

const routes = [
    { path: '/chatbox/:room_id/:room_name', name: 'chatBox', component: chatBox },
    { path: '/allrooms', component: allRooms },
    { path: '/addroom', component: addRoom },
    { path: '/myrooms', component: myRooms }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
    router
}).$mount('#app')