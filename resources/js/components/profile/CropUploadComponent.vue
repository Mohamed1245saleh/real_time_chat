<template>
  <div class="p-3 bg-white shadow rounded-lg">
    <div class="img-container">
           <img id="image" :src="imageSrc" ref="image">
        </div>
        <img id="croppedImage" :src="croppedImageSrc" class="img-preview" ref="croppedAvatar">
        <div>
        <button type="button" class="btn btn-info" @click.prevent="restoreImage">Restore</button>
        <button type="button" class="btn btn-dark" @click.prevent="uploadAvatar">Upload</button>
        </div>
  </div>
</template>

<script>
  import VueCropper from "cropperjs"
  import "cropperjs/dist/cropper.css"

  export default {
    components: {
      VueCropper,
    },props:["imageSrc"],
    data: function () {
      return {
        image: "",
        cropper:"",
        croppedImageSrc: "",
      }
    },methods:{
        restoreImage:function(){
               this.$emit('update:imageSrc', "");
            },
        uploadAvatar: function(){
        fetch(this.croppedImageSrc)
  .then(res => res.blob()) // Gets the response and returns it as a blob
  .then(blob => {
        let objectURL = URL.createObjectURL(blob);
        var imageAsFile = new File([blob], "image");
        let formData = new FormData();
        formData.append("image" , imageAsFile);
        formData.append("imageType" , blob.type);
        this.$http.post("/uploadAvatar" , formData).then(function(result){
        }, function(result){
           alert(result);
        });
    
});
        
            }
    },
    mounted(){
      this.image = this.$refs.image;
       this.cropper = new VueCropper(this.image , {
        zoomable: false,
        scalable: false,
        aspectRatio:1,
        crop:  ()=>{
            const canvas = this.cropper.getCroppedCanvas();
            this.croppedImageSrc = canvas.toDataURL("image/png");
        }
      });
    }
  }
</script>

<style scoped>
.img-container{
    width:640px;
    height:480px;
    float:left;
}
.img-preview{
    width:200px;
    height:200px;
    float:left;
    margin-left: 50px;
}
</style>