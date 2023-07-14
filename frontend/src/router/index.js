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
// const id = CryptoJS.AES.decrypt(getCookie("user_id"), "Secret id").toString(CryptoJS.enc.Utf8);

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
    path: '/admin/generations/studentList/:id',
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
    path: '/teachers',
    name: 'teachers',
    component: () => import('../views/teacher/TeacherView.vue'),
    meta: {
      requireAuth: true,
      token: token,
      role: isTeacher
    }
  },

  // Student onwer path  
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
  // {
  //   path: '/generations',
  //   name: 'generations',
  //   component: () => import('../views/admin/GenerationListView.vue'),
  // },
  // {
  //   path: '/generations/students',
  //   name: 'students',
  //   component: () => import('../views/admin/StudentListView.vue'),
  // },

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