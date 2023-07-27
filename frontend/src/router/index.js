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
  console.log(userStore.value);
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
  console.log(userStore.value.role.role == role)
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
    props: true,
    path: '/admin/generations/studentList/:id',
    name: 'studentList',
    component: () => import('../views/admin/StudentListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
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
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')]

  },
  {
    path: '/teachers',
    name: 'teachers',
    component: () => import('../views/teacher/TeacherView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')]

  },
  {
    path: '/teacher/students',
    name: 'generation_of_students',
    component: () => import('../views/admin/GenerationListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],

  },
  {
    path: '/teacher/generations/studentList/:id',
    name: 'student_in_a_generation',
    component: () => import('../views/admin/StudentListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')],
    props: true
  },

  {
    path: '/teachers/background/:id',
    name: 'teacher-background',
    component: () => import('../views/teacher/TeacherBackground.vue'),
    props: true,
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')]
  },
  {
    path: '/teacher/student/transcrypt/:user_id',
    name: 'teacher-feedback-transcript',
    component: () => import('../views/transcript/TranscriptView.vue'),
    props: true,
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')]
  },
  {
    path: '/teacher/feedback',
    name: 'teacher-feedback',
    component: () => import('../views/admin/GenerationListView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('teacher')]
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/student/StudentView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')]

  },
  {
    path: '/students/background/:id',
    name: 'student-background',
    component: () => import('../views/student/StudentBackground.vue'),
    props: true,
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')]
  },
  {
    path: '/students/schedule',
    name: 'student-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')]
  },
  {
    path: '/students/transcript',
    name: 'student-transcript',
    component: () => import('../views/transcript/TranscriptView.vue'),
  },
  {
    path: '/admin/students/term/:id',
    name: 'student-transcript',
    component: () => import('../views/transcript/TermView.vue'),
    props: true,
  },
  {
    path: '/students/transcript/:user_id',
    name: 'self-student-transcript-id',
    component: () => import('../views/transcript/TranscriptView.vue'),
    beforeEnter: [isUserLoginRequired, isUserRoleRequired('student')],
  },
  {
    path: '/admin/students/term/createtranscript/:term_id',
    name: 'student_in_a_term',
    component: () => import('../views/transcript/CreateTranscript.vue'),
    // beforeEnter: [isUserLoginRequired, isUserRoleRequired('admin')],
    props: true
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



  {
    path: '/404',
    name: 'page-not-found',
    component: () => import('../views/404/PageNotFound.vue')
  },


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router