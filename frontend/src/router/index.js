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
      // role: role,
      token: token
    }
  },
  {
    path: '/teacher',
    name: 'teacher',
    component: () => import('../views/teacher/TeacherView.vue'),
    meta: {
      requireAuth: true,
      // role: role,
      token: token
    }
  },
  {
    path: '/student',
    name: 'student',
    component: () => import('../views/student/StudentView.vue'),
    meta: {
      requireAuth: true,
      // role: role,
      token: token
    }
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
