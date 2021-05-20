<template>
  <iframe :src="fileUrl" width="100%" height="100%" frameborder="0"></iframe>
</template>

<script>
export default {
  data() {
    return {
      fileUrl: null,
    }
  },
  mounted() {
    axios.get('/cert/'+this.$route.params.id,{
      responseType: 'arraybuffer'
    }).then(response => {
      let blob = new Blob([response.data], { type: 'application/pdf' }),
          url = window.URL.createObjectURL(blob)

      this.fileUrl = url;

      console.log(url)
    });
  }
}
</script>

<style lang="scss" scoped>
iframe {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
}
</style>