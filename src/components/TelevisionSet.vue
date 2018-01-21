<template>
    <div>
        <div v-if="skin" :style="{position: 'relative'}">
            <img :src="skin.back.image_url" v-bind:style="{position: 'absolute', left: '0pt', top: '0pt'}">
            <div v-bind:class="[crt ? 'crt' : '', flicker ? 'flicker' : '']" >
                <iframe :width="skin.formats[format].width" :height="skin.formats[format].height" v-bind:style="{position: 'absolute', left: skin.formats[format].left, top: skin.formats[format].top, 'filter': 'saturate(' + saturate + '%)', opacity: skin.opacity}" :src="src + '?playsinline=1&autoplay=1'" frameborder="0" allow="encrypted-media"></iframe>
            </div>
            <img :src="skin.front.image_url" v-bind:style="{'pointer-events': 'none', 'position': 'absolute', 'left': '0pt', 'top': '0pt', 'z-index': 10000}">
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
            'saturate': {
                type: Number,
                default: 50
            },
            'skin_src': {
                type: String
            },
            'src': {
                type: String,
                default: 'https://www.youtube.com/watch?v=tS27hJv-g4w'
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
        watch: {
            skin_url(newVal, oldVal) {
                this.loadSkin(newVal)
            }
        },
        mounted() {
            console.log(this.format)
            this.loadSkin(this.skin_src)  
        },
        methods: {
            
            loadSkin(url) {
                axios.get(url).then((response) => {
                    this.skin = response.data
                })
            }
        }
    }
</script>