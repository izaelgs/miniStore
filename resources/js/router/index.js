import NotFound from '../pages/NotFound';
import Home from '../pages/Home';

import Register from '../pages/Register';
import Login from '../pages/Login';

import Profile from '../pages/Profile';
import Cart from '../pages/Cart';
import orderAddress from '../pages/orderAddress';
import orderPayment from '../pages/orderPayment';

import Product from '../pages/Product';

import Guard from '../services/middleware';

import { createRouter, createWebHistory } from 'vue-router';

export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/:catchAll(.*)',
            name: 'notfound',
            component: NotFound,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/product/:slug',
            name: 'product',
            component: Product,
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            beforeEnter: Guard.auth
        },
        {
            path: '/cart',
            name: 'cart',
            component: Cart,
            beforeEnter: Guard.auth
        },
        {
            path: '/orderAddress',
            name: 'orderAddress',
            component: orderAddress,
            beforeEnter: Guard.auth
        },
        {
            path: '/orderPayment',
            name: 'orderPayment',
            component: orderPayment,
            beforeEnter: Guard.auth
        },
    ]
})
