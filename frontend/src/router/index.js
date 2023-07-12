import { createRouter, createWebHistory } from 'vue-router'
import CryptoJS from 'crypto-js'

function getCookie(user_token_in_store) {
  var cookieName = user_token_in_store + '=';
  var decodedCookie = decodeURIComponent(document.cookie);
  var splitToJsonFormat = decodedCookie.split(';');
  for (var i = 0; i < splitToJsonFormat.length; i++) {
    var cookie = splitToJsonFormat[i];
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
const role = CryptoJS.AES.decrypt(getCookie('user_role'), "Screat role").toString(CryptoJS.enc.Utf8)
console.log(token)
console.log(role)


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
    component: () => import('../views/SchoolAdmin.vue'),
    meta: {
      requireAuth: true,
      role: 'admin',

    }
  },
  {
    path: '/admin/teachers',
    name: 'teachers',
    component: () => import('../views/TeacherView.vue'),
  },
  {
    path: '/generation/studentList',
    name: 'student',
    component: () => import('../views/TeacherView.vue'),
  },
  {
    path: '/404',
    name: '404',
    component: () => import('../views/404/PageNotFound.vue'),
    meta: {
      requireAuth: false,
    },

  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, _, next) => {
  if (to.meta.requireAuth) {
    if (token) {
      if (to.meta.role == role) {
        next();
      } else {
        next('/404');
      }
    }
  }
});


export default router
