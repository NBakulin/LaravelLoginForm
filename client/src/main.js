import { createApp } from 'vue'
import App from './App.vue'
import Axios from 'axios'

const app = createApp(App);

app.config.globalProperties.$axios = Axios.create({
    baseURL: process.env.VUE_APP_BASE_URL
});

app.mount("#app")
