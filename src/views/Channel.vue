<template>
    <div>
        <television-set v-if="src" :skin_src="skin_src" :flicker="flicker" crt="crt" :format="format" :src="src | formatUrl"></television-set>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                skin: null,
                format: 'modern',
                skin_src: '/static/skins/oldschool.json',
                src: 'start',
                crt: true,
                flicker: false,
                chooseChannel: false
            }
        },
        watch: {
            '$route'(to, from) {
                this.load(this.$route.query.skin, this.$route.query.src, this.$route.query.format, this.$route.query.crt == 'true', this.$route.query.flicker == 'true')
            }
        },
        mounted() {
            this.load(this.$route.query.skin, this.$route.query.src, this.$route.query.format, this.$route.query.crt == 'true', this.$route.query.flicker == 'true')
          
      
        },
        methods: {
            load(skin, src, format, crt, flicker) {
                this.skin_src = '/static/skins/' + this.skin + '.json'
                this.src = src
                this.format = format
                this.crt = crt
                this.flicker = flicker
            }
        },
        props: {
        }
    }
</script>