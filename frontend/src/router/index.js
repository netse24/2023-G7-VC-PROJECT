import { createRouter, createWebHistory } from 'vue-router'
import { AES, enc } from 'crypto-js';

function getCookie(user_token_in_store) {
  let cookieName = user_token_in_store + '=';
  let decodedCookie = decodeURIComponent(document.cookie);
  let splitToJsonFormat = decodedCookie.split(';');
  for (let i = 0; i < splitToJsonFormat.length; i++) {
    let cookie = splitToJsonFormat[i];
    while (cookie.charAt(0) == ' ') {
      cookie = cookie.substring(1);
    }
    if (cookie.indexOf(cookieName) == 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return "";
}
const token = getCookie('user_token')
const role = AES.decrypt(getCookie("user_role"), "Secret role").toString(enc.Utf8)
const id = AES.decrypt(getCookie("user_id"), "Secret id").toString(enc.Utf8);
console.log(role);
console.log(id);

// define role 
var isAdmin = null;
var isTeacher = null;
var isStudent = null;
if (role == 'admin') {
  isAdmin = role
} else if (role == 'teacher') {
  isTeacher = role
} else if (role == 'student') {
  isStudent = role
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
      token: token,
      role: isAdmin
    }
  },
  {
    path: '/admin/students',
    name: 'generations',
    component: () => import('../views/admin/GenerationListView.vue'),
    meta: {
      requireAuth: true,
      token: token,
      role: isAdmin
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
      token: token,
      // role: isAdmin
    },
  },
  {
    path: '/admin/batch/student_detail/:user_id',
    name: 'studentsList',
    component: () => import('../views/student/StudentDetailView.vue'),
    meta: {
      requireAuth: true,
      token: token,
      // role: isAdmin
    },
    props: true
  },
  {
    path: '/admin/schedule',
    name: 'schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
    meta: {
      requireAuth: true,
      token: token,
      role: isAdmin
    },
    props: true
  },


  // teacher onwer path 
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
      token: token,
      role: isTeacher
    }
  },
  // {
  //   path: '/teacher/detail',
  //   name: 'teacher-detail',
  //   component: () => import('../views/teacher/TeacherDetail.vue'),
  // },
  {
    path: '/teachers/background/:id',
    name: 'teacher-background',
    component: () => import('../views/teacher/TeacherDetail.vue'),
    props: true
  },

  {
    path: '/students',
    name: 'students',
    component: () => import('../views/student/StudentView.vue'),
    meta: {
      requireAuth: true,
      token: token,
      role: isStudent
    }
  },
  {
    path: '/student/schedule',
    name: 'student-schedule',
    component: () => import('../views/schedule/ScheduleView.vue'),
  },

  {
    path: '/404',
    name: '404',
    component: () => import("../views/404/PageNotFound.vue"),
    meta: {
      requireAuth: false,
    },
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// router.beforeEach((to, _, next) => {
//   if (to.meta.requireAuth) {
//     if (token) {
//       if (to.meta.role == role) {
//         next();
//       } else {
//         next('/404');
//       }
//     }
//   }
// });


export default router