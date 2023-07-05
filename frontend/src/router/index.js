import { createRouter, createWebHistory } from 'vue-router'
import SchoolAdmin from '../views/SchoolAdmin.vue'

const routes = [
  {
    path: '/admin',
    name: 'home',
    component: SchoolAdmin
  },
  {
    path: '/student',
    name: 'home',
    component: SchoolAdmin
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
