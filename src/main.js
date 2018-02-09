// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import TelevisionSet from './components/TelevisionSet'
import ChannelChooser from './components/ChannelChooser'
import axios from 'axios'

Vue.filter('formatUrl', function (input) {
  let embedYtTemplate = 'https://www.youtube.com/embed/'
  let url = input
  let id
  if (url.indexOf('https://www.tv4play.se/program') === 0) {
    id = url.split(/\//)[5]
    url = 'https://www.tv4play.se/iframe/video/' + id
  }
  if (url.indexOf('https://youtu.be') === 0) {
    id = url.split(/\//)[3]
    url = embedYtTemplate + id
  } else if (url.indexOf('https://www.youtube.com/watch?v=') === 0) {
    id = url.split('=')[1]
    id = id.split('&')[0]
    url = embedYtTemplate + id
  }
  return url
})

Vue.component('television-set', TelevisionSet)
Vue.component('channel-chooser', ChannelChooser)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
