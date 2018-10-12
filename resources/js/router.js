import Vue from 'vue'
import VueRouter from 'vue-router'

import home from './components/Home.vue'
import code from './components/Code.vue'

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
  }
];

export default new VueRouter({
  routes: routes
});
