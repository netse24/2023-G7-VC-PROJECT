import { createRouter, createWebHistory } from 'vue-router';
import { storeManageCookie } from '@/store/cookie';
import { userInformations } from '@/store/userStore';
import { storeToRefs } from 'pinia';

// https://router.vuejs.org/guide/advanced/navigation-guards.html
const isUserLoginRequired = async (to, from, next) => {
  const { getCookie } = storeManageCookie();
  const { getUserData } = userInformations();
  const { userStore } = storeToRefs(userInformations()); // use to get user data that store in state in userSore in pinia
  await getUserData();
  if (userStore.value !== null && getCookie('user_token')) {
    next()
  } else {
    next('/login')
  }
}

// call back function find user role 
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

  //--------------------------------------- admin routes  -------------------------------------//

  {
    path: '/admin',
    name: 'admin',
    component: () => import('../views/admin/SchoolAdmin.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')]
  },
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
    path: '/admin/students/term/:id',
    name: 'admin-student-transcript',
    component: () => import('../views/transcript/TermView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true,
  },
  {
    path: '/admin/students/term/createtranscript/:term_id',
    name: 'student-in-a-term',
    component: () => import('../views/transcript/CreateTranscript.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true
  },

  //--------------------------------------- teacher routes  -------------------------------------//

  {
    path: '/teachers',
    name: 'teachers',
    component: () => import('../views/teacher/TeacherView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
  },
  {
    path: '/teachers/background/:id',
    name: 'teacher-background',
    component: () => import('../views/teacher/TeacherBackground.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
    props: true,
  },
  {
    path: '/teacher/schedule',
    name: 'teacher-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
  },
  {
    path: '/teacher/students',
    name: 'generation-of-students',
    component: () => import('../views/admin/GenerationListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
  },
  {
    path: '/teacher/generations/studentList/:id',
    name: 'student-in-a-generation',
    component: () => import('../views/admin/StudentListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
    props: true,
  },
  {
    path: '/teacher/student/transcrypt/:user_id',
    name: 'teacher-feedback-transcript',
    component: () => import('../views/transcript/TranscriptView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
    props: true,
  },
  {
    path: '/teacher/feedback',
    name: 'teacher-feedback',
    component: () => import('../views/admin/GenerationListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
  },

  //--------------------------------------- student routes  -------------------------------------//

  {
    path: '/students',
    name: 'students',
    component: () => import('../views/student/StudentView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
  },
  {
    path: '/students/background/:id',
    name: 'student-background',
    component: () => import('../views/student/StudentBackground.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
    props: true,
  },
  {
    path: '/students/schedule',
    name: 'student-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
  },
  {
    path: '/students/transcript',
    name: 'student-transcript',
    component: () => import('../views/transcript/TranscriptView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
  },
  {
    path: '/students/transcript/:user_id',
    name: 'self-student-transcript-id',
    component: () => import('../views/transcript/TranscriptView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
    props: true,
  },
  {
    path: '/forget-password',
    name: 'forget-password',
    component: () => import('../views/forget-password/ForgetPassword.vue'),
    beforeEnter: (to, from, next) => {
      if (from.name === 'login') {
        // Allow access to the "forget-password" route if we from the login
        next();
      } else {
        // Redirect to another route or show an error message
        next('/'); // Redirect to the home page login page
      }
    },
  },
  {
    path: '/reset-password',
    name: 'reset-password',
    component: () => import('../views/forget-password/ResetPassword.vue'),
    beforeEnter: (to, from, next) => {
      if (from.name === 'forget-password') {
        // Allow access to the "reset-password" route
        next();
      } else {
        // Redirect to another route or show an error message
        next('/'); // Redirect to the home page
      }
    },
  },

  //--------------------------------------- page not found routes  -------------------------------------//

  {
    path: '/404',
    name: 'page-not-found',
    component: () => import('../views/404/PageNotFound.vue')
  },

  // zzzocode.ai keySearch  = Make all pages not found to 404 page (Subject Vue Router).
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    redirect: '/404',
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router