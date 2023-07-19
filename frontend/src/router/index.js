import { createRouter, createWebHistory } from 'vue-router'
import { storeManageCookie } from '@/store/cookie';
import { userInformations } from '@/store/userStore';
import { storeToRefs } from 'pinia';

const isUserLoginRequired = async (to, from, next) => {
  const { getCookie } = storeManageCookie();
  const { getUserData } = userInformations();
  const { userStore } = storeToRefs(userInformations()); // use to get user data that store in state in userSore in pinia
  await getUserData();
  console.log(userStore.value)
  if (userStore && getCookie('user_token')) {
    next()
  } else {
    next('/login')
  }
}

const isUserRoleRequired = (role) => async (to, from, next) => {
  const { getUserData } = userInformations();
  const { userStore } = storeToRefs(userInformations());
  await getUserData();
  if (userStore.value.role.role == role) {
    next()
  } else {
    next('/404')
  }
}

const routes = [
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/login/LoginView.vue'),
  },
  {
    path: '/admin',
    name: 'admin',
    component: () => import('../views/admin/SchoolAdmin.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')]
  },
  // list generation by admin
  {
    path: '/admin/students',
    name: 'generations',
    component: () => import('../views/admin/GenerationListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true
  },
  {
    path: '/admin/generations/studentList/:id',
    name: 'studentList',
    component: () => import('../views/admin/StudentListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true,
  },
  {
    path: '/admin/students/detail/:student_id',
    name: 'admin-students-detail',
    component: () => import('../views/student/StudentDetailView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true
  },
  {
    path: '/admin/teachers',
    name: 'admin-teachers',
    component: () => import('../views/admin/TeacherListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
  },
  {
    path: '/admin/teachers/detail/:teacher_id',
    name: 'admin-teachers-detail',
    component: () => import('../views/teacher/TeacherDetailView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true
  },

  {
    path: '/admin/schedule',
    name: 'admin-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')]

  },
  {
    path: '/teacher/schedule',
    name: 'teacher-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
  },
  {
    path: '/teachers',
    name: 'teachers',
    component: () => import('../views/teacher/TeacherView.vue'),
    meta: {
      requireAuth: true,
    }
  },
  {
    path: '/teachers/background/:id',
    name: 'teacher-background',
    component: () => import('../views/teacher/TeacherBackground.vue'),
    props: true
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/student/StudentView.vue'),
    meta: {
      requireAuth: true,
    }
  },
  {
    path: '/students/schedule',
    name: 'student-schedule',
    meta: {
      requireAuth: true
    }
  },

  {
    path: '/404',
    name: 'page-not-found',
    component: () => import('../views/404/PageNotFound.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router