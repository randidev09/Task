import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home'
import Login from '@/views/Login'
import Register from '@/views/Register'
import Company from '@/views/Company'
import FavCompany from '@/views/FavCompany'

Vue.use(Router)

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/company', component: Company },
    { path: '/favcompany', component: FavCompany },
]

const router = new Router({
    routes,
    mode: 'history'
})

export default router;
