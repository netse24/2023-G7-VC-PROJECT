import { createRouter, createWebHistory } from 'vue-router'
import CryptoJS from 'crypto-js';
function getCookie(name) {
  var cname = name + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var splitDataToJsonFormat = decodedCookie.split(";");
  for (var i = 0; i < splitDataToJsonFormat.length; i++) {
      var cookie = splitDataToJsonFormat[i];
      while (cookie.charAt(0) == " ") {
          cookie = cookie.substring(1);
      }
      if (cookie.indexOf(cname) == 0) {
          return cookie.substring(cname.length, cookie.length);
      }
  }
  return "";
} 
const token = getCookie('user_token')
const role = CryptoJS.AES.decrypt(getCookie("user_role"), "Secret role").toString(CryptoJS.enc.Utf8)
const id = CryptoJS.AES.decrypt(getCookie("user_id"), "Secret id").toString(CryptoJS.enc.Utf8);
console.log(role);
console.log(id);

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
      token: token
    }
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
  },
  {
    path: '/generation/studentList',
    name: 'studentsList',
    component: () => import('../views/teacher/TeacherView.vue'),
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/student/StudentView.vue'),
    meta: {
      requireAuth: true,
      token: token
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