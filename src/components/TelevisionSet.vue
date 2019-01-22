<template>
  <div>
    
    <div v-if="skin" :style="{position: 'relative'}">
    
      <img :src="skin.back.image_url">
      <div v-bind:class="[crt ? 'crt' : '', flicker ? 'crt-flickering' : '']" >
        <iframe :width="skin.formats[format].width" :height="skin.formats[format].height" v-bind:style="{position: 'absolute', left: skin.formats[format].left, top: skin.formats[format].top, 'filter': ' saturate(' + saturate + '%), custom(url(/static/shaders/fisheye.vs) mix(url(/static/shaders/fisheye.fs) normal source-atop)', opacity: skin.opacity} " :src="url + '?playsinline=1&autoplay=1'" frameborder="0" allow="encrypted-media"></iframe>
      </div>
      <img :src="skin.front.image_url" v-bind:style="{'opacity': 1, 'backdrop-filter': 'sepia(' + skin.sepia + ')', 'pointer-events': 'none', 'position': 'absolute', 'left': '0pt', 'top': '0pt', 'z-index': 10000}">
      <footer style="background-color: white; z-index: 10000; left: 0pt; top: 0pt; position: absolute">&copy 2018 <a href="https://buddhalow.se" target="_blank"><img style="display: inline-block; width: 10px" src="/static/images/logo.svg">Buddhalow Music</a>. CRT effect by <a href="http://aleclownes.com/2017/02/01/crt-display.html">@aleclownes</a>. Image by <a>{{skin.source.by}}</a> licensed under <a>{{skin.source.license}}</a></footer>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
  export default {
    data() {
      return {  
        skin: null
      }
    },
    props: {
      'format': {
        type: String
      },
      'blur': {
        type: Number,
           default: 1.28
      },
      'saturate': {
        type: Number,
        default: 50
      },
      'skin_src': {
        type: String
      },
      'src': {
        type: String,
        default: 'start'
      },
      'crt': {
        type: Boolean,
        default: false
      },
      'flicker': {
        type: Boolean,
        default: false
      }
    },
    computed: {
      url() {
        if (this.src.indexOf('http') != 0) {
          return '/static/pages/' + this.src + '.html'
        } else {
          return this.src
        }
      }
    },
    watch: {
      skin_url(newVal, oldVal) {
        this.loadSkin(newVal)
      },
      src(newVal, oldVal) {
      }
    },
    mounted() {
      console.log(this.skin)
      console.log(this.format)
      this.loadSkin(this.skin_src)  
       window.addEventListener('message', (e) => {
        if (e.data && e.data.action == 'chooseChannel') {
          this.$router.push({
            path: '/',
            query: e.data
          })
        }
      })
    },
    methods: {
      
      loadSkin(url) {
        axios.get(url).then((response) => {
          this.skin = response.data
          this.saturate = this.skin.saturate * 100
        })
      }
    }
  }
</script>