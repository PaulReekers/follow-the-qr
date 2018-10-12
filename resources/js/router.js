import Vue from 'vue'
import VueRouter from 'vue-router'

import home from './components/Home.vue'
import code from './components/Code.vue'
import why from './components/Why.vue'
import highscore from './components/Highscore.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '*',
    name: 'home',
    component: home,
    meta: {
      title: ''
    }
  },{
    path: '/code/:id',
    name: 'code',
    component: code,
    meta: {
      title: 'Code'
    }
  },{
    path: '/howitworks',
    name: 'howitworks',
    component: why,
    meta: {
      title: 'How it works'
    }
  },{
    path: '/highscore',
    name: 'highscore',
    component: highscore,
    meta: {
      title: 'Highscore'
    }
  }
];

export default new VueRouter({
  routes: routes
});
