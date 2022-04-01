<template>
   <VueEmoji ref="emoji" @input="onInput" :value="myText" />
</template>



<script>
import VueEmoji from 'emoji-vue'
//in component def
export default{
    data: function () {
    return {
      myText:""
    }
    },components:{
     VueEmoji:VueEmoji
    },
  methods: {
      onInput() {
          //event.data contains the value of the textarea
      },
      clearTextarea(){
        this.$refs.emoji.clear()
      },  
  }}
  
</script>
