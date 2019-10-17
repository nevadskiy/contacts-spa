import Home from './views/Home.vue';
import ContactsCreate from './views/contacts/Create.vue';

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/contacts/create',
            name: 'contacts.create',
            component: ContactsCreate,
        }
    ],
};
