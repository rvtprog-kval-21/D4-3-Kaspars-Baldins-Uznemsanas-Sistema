import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/aktivadiena.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/aktivadiena',
    name: 'aktivadiena',
    component: () => import(/* webpackChunkName: "about" */ '../views/aktivadiena.vue')
  },
  {
    path: '/visistudenti',
    name: 'visistudenti',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/visistudenti.vue')
  },
  {
    path: '/grupas',
    name: 'grupas',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/grupas.vue')
  },
  {
    path: '/statistika',
    name: 'statistika',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/statistika.vue')
  },
  {
    path: '/login',
    name: 'Login',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Login.vue')
  },
  {
    path: '/',
    name: 'iesniegums',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/iesniegums.vue')
  },
  {
    path: '/specialitate',
    name: 'specialitate',
    component: () => import('../views/specialitate.vue')
  },
  {
    path: '/print/application/:id',
    name: 'print_application',
    component: () => import('../views/print/application.vue')
  },
  {
    path: '/print/cert/:id',
    name: 'print_cert',
    component: () => import('../views/print/cert.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
