import { createApp } from 'vue'
import { createWebHistory, createRouter,  } from "vue-router";
import App from './App.vue'
import VueSweetalert2 from 'vue-sweetalert2';
import money from 'vuejs-money'
import Notification from 'notiwind'

//views
import Dashboard from './logged/Dashboard'
import Categories from './logged/Categories'
import Home from './Home'
import Login from './Login'
import Register from './Register'

//css
import './assets/tailwind.css'
import 'sweetalert2/dist/sweetalert2.min.css';

//middlewares
import Guard from './middleware/auth';

import store from './store'




const routes = [
    {
      name: "Dashboard",
      path: "/dashboard",
      component: Dashboard,
      beforeEnter: Guard.auth
    },
    {
      name: "Categorias",
      path: "/categories",
      component: Categories,
      beforeEnter: Guard.auth
    },
    {
      name: "Home",
      path: "/",
      component: Home,
    },
    {
      name: "Login",
      path: "/entrar",
      component: Login,
    },
    {
      name: "Registrar",
      path: "/registro",
      component: Register,
    },
  ];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


const app = createApp(App).use(store)
app.use(router);
app.mount('#app');
app.use(VueSweetalert2);
app.use(money);
app.use(Notification);
