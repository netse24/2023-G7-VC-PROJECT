import { createRouter, createWebHistory } from 'vue-router'
import SchoolAdmin from '../views/SchoolAdmin.vue'
import TeacherView from '../views/TeacherView.vue'
import LoginView from '../views/login/LoginView.vue'
import Schedule from '../views/schedule/ScheduleView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    component: SchoolAdmin
  },
  {
    path: '/admin/teachers',
    name: 'teachers',
    component: TeacherView
  },
  {
    path: '/admin/schedule',
    name: 'schedule',
    component: Schedule
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
