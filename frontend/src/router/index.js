import { createRouter, createWebHistory } from 'vue-router'
import { storeManageCookie } from '@/store/cookie';
import { userInformations } from '@/store/userStore';
import { storeToRefs } from 'pinia';

// import { AES, enc } from 'crypto-js';

// function getCookie(user_token_in_store) {
//   let cookieName = user_token_in_store + '=';
//   let decodedCookie = decodeURIComponent(document.cookie);
//   let splitToJsonFormat = decodedCookie.split(';');
//   for (let i = 0; i < splitToJsonFormat.length; i++) {
//     let cookie = splitToJsonFormat[i];
//     while (cookie.charAt(0) == ' ') {
//       cookie = cookie.substring(1);
//     }
//     if (cookie.indexOf(cookieName) == 0) {
//       return cookie.substring(cookieName.length, cookie.length);
//     }
//   }
//   return "";
// }
// const token = getCookie('user_token')
// const role = AES.decrypt(getCookie("user_role"), "Secret role").toString(enc.Utf8)
// const id = AES.decrypt(getCookie("user_id"), "Secret id").toString(enc.Utf8);
// console.log(role);
// console.log(id);

// define role 

const isLoginRequired = async (to, from, next) => {
  const { getCookie } = storeManageCookie();
  const { getUserData } = userInformations();
  const { getStoreUser } = storeToRefs(getUserData()); // use to get user data that store in state in userSore in pinia
  await getUserData();
  if (getStoreUser.value && getCookie('user_token')) {
    next()
  } else {
    next('/')
  }
}

const isUserRole = async (to, from, next) => {
  
}





// var isAdmin = null;
// var isTeacher = null;
// var isStudent = null;
// if (role == 'admin') {
//   isAdmin = role
// } else if (role == 'teacher') {
//   isTeacher = role
// } else if (role == 'student') {
//   isStudent = role
// }

const routes = [
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/login/LoginView.vue'),
    meta: {
      requireAuth: false,
    },
  },
  {
    path: '/admin',
    name: 'admin',
    component: () => import('../views/admin/SchoolAdmin.vue'),
    meta: {
      requireAuth: true,
    }
  },
  {
    path: '/admin/students',
    name: 'generations',
    component: () => import('../views/admin/GenerationListView.vue'),
    meta: {
      requireAuth: true,
    },
    props: true
  },

  // list generation by admin
  {
    props: true,
    path: `/admin/generations/studentList/:id`,
    name: 'studentList',
    component: () => import('../views/admin/StudentListView.vue'),
    meta: {
      requireAuth: true,
    },
    path: '/admin/teachers',
    name: 'admin-teachers',
    component: () => import('../views/admin/TeacherListView.vue'),
  },
  {
    path: '/admin/teachers/detail',
    name: 'admin-teachers-detail',
    component: () => import('../views/teacher/TeacherDetailView.vue'),
  },
  {
    path: '/admin/students/detail',
    name: 'admin-students-detail',
    component: () => import('../views/student/StudentDetailView.vue'),
    meta: {
      requireAuth: true,
    },
    props: true
  },
  {
    path: '/admin/schedule',
    name: 'admin-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
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