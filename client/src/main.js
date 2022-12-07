import { createApp } from 'vue'
import App from './App.vue'
import Dashboard from "@/components/DashboardComponent";
import Login from "@/components/LoginComponent";
import Signup from "@/components/SignupComponent";
import Axios from 'axios'
import { createRouter, createWebHistory } from 'vue-router'
import VueCookies from 'vue-cookies'
import 'vue3-timepicker/dist/VueTimepicker.css'

const app = createApp(App);

app.config.globalProperties.$axios = Axios.create({
    baseURL: process.env.VUE_APP_BASE_URL
});

const routes = [
    { path: '/login', name: 'login', component: Login },
    { path: '/signup', name: 'signup', component: Signup },
    { path: '/dashboard', name: 'dashboard', component: Dashboard },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

app.use(VueCookies, { expires: '1d'})
app.use(router);
app.mount("#app");
