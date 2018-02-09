<template>
  <form v-on:submit.prevent="onSubmit">
    <label for="url" class="label">Enter YouTube URL</label>
    <input type="url" v-model="src" class="form-control" placeholder="https://www.youtube.com/watch?v=n7PWpQ-rISk"><br>
    <select v-model="format">
      <option disabled value="">Select format</option>
      <option value="modern">Modern</option>
      <option value="old school">ld school format (Better for old videos ripped from television)</option>
    </select>
    <input type="checkbox" v-model="crt" value="true"> Enable CRT screen effect<br>
    <input type="checkbox" v-model="flicker" value="true"> Enable CRT flickering<br>
    <button class="btn btn-primary" type="submit">View!</button>
  </form>
</template>
<script>
  export default {
    data() {
      return {
        format: 'modern',
        crt: false,
        flicker: false,
        src: '',
        skin: 'oldschool'
      }
    },
    methods: {
      onSubmit (e) {
        this.$router.push({
          path: '/channel',
          query: {
            format: this.format,
            crt: this.crt,
            flicker: this.flicker,
            src: this.src,
            skin: this.skin
          }
        })
      }
    }
  }
</script>