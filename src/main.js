// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import TelevisionSet from './components/TelevisionSet'
import ChannelChooser from './components/ChannelChooser'
import axios from 'axios'

Vue.filter('formatUrl', function (input) {
  let embed_yt_template = "https://www.youtube.com/embed/";
  let url = input
  if (url.indexOf('https://youtu.be') == 0) {
      let id = url.split(/\//)[2];
      url = embed_yt_template + id;
  } else if (url.indexOf('https://www.youtube.com/watch?v=') === 0) {
      let id = url.split('=')[1];
      id = id.split('&')[0];
      url = embed_yt_template + id;
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
