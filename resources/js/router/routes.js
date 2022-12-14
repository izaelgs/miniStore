import Home from '../pages/Home';
import NotFound from '../pages/NotFound';
import Register from '../pages/Register';
import Product from '../pages/Product';
import CreateTarget from '../pages/CreateTarget';
import Login from '../pages/Login';

import Guard from '../services/middleware';

export default {
    mode: 'history',
    linkActiveClass: 'fw-bolder',

    routes: [
        {
            path: '*',
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
            beforeEnter: Guard.auth
        },
        {
            path: '/new-target',
            name: 'new-target',
            component: CreateTarget,
            beforeEnter: Guard.auth
        },
    ]
}
