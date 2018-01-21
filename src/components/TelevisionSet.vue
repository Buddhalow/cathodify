<template>
    <div>
        <div v-if="skin" :style="{position: 'relative'}">
            <img :src="skin.back.image_url" v-bind:style="{position: 'absolute', left: '0pt', top: '0pt'}">
            <div v-bind:class="[crt ? 'crt' : '', flicker ? 'flicker' : '']" >
                <iframe :width="skin.formats[format].width" :height="skin.formats[format].height" v-bind:style="{position: 'absolute', left: skin.formats[format].left, top: skin.formats[format].top, 'filter': 'saturate(' + saturate + '%) blur(' + blur + 'px)', opacity: skin.opacity}" :src="url + '?playsinline=1&autoplay=1'" frameborder="0" allow="encrypted-media"></iframe>
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
            console.log(this.format)
            this.loadSkin(this.skin_src)  
             window.addEventListener('message', (e) => {
                if (e.data && e.data.action == 'chooseChannel') {
                    this.$router.push({
                        path: '/channel',
                        query: e.data
                    })
                }
            })
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