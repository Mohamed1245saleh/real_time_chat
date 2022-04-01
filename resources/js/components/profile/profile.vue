<template>
   <div>
      <form class="form-group" @change="uploadAvatar()" enctype="multipart/form-data">
        <label class="input-group-text" for="inputGroupFile02" >Upload</label>
        <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="imageUpload" ref="file">
        </div>
        <!-- <button type="submit" class="btn btn-info btn-lg">Submit</button> -->
        </form>
        <image_cropper v-if="imageSrc" :imageSrc.sync="imageSrc"></image_cropper>
</div>
</template>
<style scoped>
img {
  display: block;

  /* This rule is very important, please don't ignore this */
  max-width: 100%;
}
</style>

<script>
import imageCropper from './CropUploadComponent.vue'

export default {
  components:{
     image_cropper: imageCropper
  },
  data: function () {
    return {
      imageSrc:"",
      previewImage:null
    };
  },methods:{
      uploadAvatar : function(){
        
        let image1 = this.$refs.file.files[0];
        this.imageSrc = URL.createObjectURL(image1);
        
     }
  }
};
</script>