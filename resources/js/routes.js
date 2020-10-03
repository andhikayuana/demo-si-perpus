
import LoginComponent from './components/pages/LoginComponent';
import HomeComponent from './components/pages/HomeComponent';

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeComponent,
        props: {
            header: 'Header satu',
            body: 'ini body teksnya'
        },
        meta: {
            needAuth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent,
        meta: {
            guest: true
        }
    }
];

export default routes;