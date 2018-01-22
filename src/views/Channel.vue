<template>
    <div>
        <television-set v-if="src" :skin_src="skin_src" :flicker="flicker" crt="crt" :format="format" :src="src | formatUrl"></television-set>
    </div>
</template>
<script>
    export default {
        data() {
            return {
            }
        },
        computed: {
            skin_src() {
                return '/static/skins/' + this.skin + '.json'
            },
            skin() {
                return this.$route.query.skin || 'oldschool'
            },
            src() {
                return this.$route.query.src || 'start'
            },
            format() {
                return this.$route.query.format || 'oldschool'
            },
            crt() {
                return this.$route.query.crt == 'true' || false
            },
            flicker() {
                return this.$route.query.flicker == 'true' || false
            }
        },
        watch: {
            '$route'(to, from) {
                this.$nextTick(() => {
                    
                })
            }
        },
        mounted() {
            this.$nextTick(() => {
                
            })
        },
        methods: {
            load(skin, src, format, crt, flicker) {
        
            }
        },
        props: {
        }
    }
</script>