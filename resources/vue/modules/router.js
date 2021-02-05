import Main from '../Main';
import Login from "../Login";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Main,
            meta: { requiresAuth: true }
        },
        {
            path: '/login',
            component: Login
        },
    ]
};
