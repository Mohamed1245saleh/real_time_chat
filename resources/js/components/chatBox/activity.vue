<template>
  <div class="activity">
    <ul class="list-group">
      <li class="list-group-item" v-for="activityMessage in recievedActivityMessage"
      :key="activityMessage">{{ activityMessage }}</li>
      <br />
    </ul>
  </div>
</template>
<style scoped>
.activity {
  max-height: 200px;
  overflow-y: scroll;
  
}
</style>
<script>
export default {
  props: ["recievedActivityMessage"],
  data: function () {
    return {};
  },
};
</script>