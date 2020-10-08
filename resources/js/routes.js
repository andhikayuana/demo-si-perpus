
import LoginComponent from './components/pages/LoginComponent';
import HomeComponent from './components/pages/HomeComponent';
import MemberComponent from './components/pages/MemberComponent';
import BookCategoryComponent from './components/pages/BookCategoryComponent';
import BookComponent from './components/pages/BookComponent';
import TrxBorrowComponent from './components/pages/TrxBorrowComponent';
import TrxReturnComponent from './components/pages/TrxReturnComponent';

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeComponent,
        props: {
            header: 'SI Perpus',
            body: 'ini body teksnya'
        },
        meta: {
            needAuth: true
        },
        children: [
            {
                path: 'members',
                name: 'member',
                component: MemberComponent
            },
            {
                path: 'book-categories',
                name: 'book-category',
                component: BookCategoryComponent
            },
            {
                path: 'books',
                name: 'book',
                component: BookComponent
            },
            {
                path: 'trx-borrows',
                name: 'trx-borrow',
                component: TrxBorrowComponent
            },
            {
                path: 'trx-returns',
                name: 'trx-return',
                component: TrxReturnComponent
            },
        ]
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