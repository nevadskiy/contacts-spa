import Home from './views/Home.vue';
import ContactsCreate from './views/contacts/Create.vue';
import ContactsShow from './views/contacts/Show.vue';

export default {
  mode: 'history',

  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/contacts/create',
      name: 'contacts.create',
      component: ContactsCreate,
    },
    {
      path: '/contacts/:id',
      name: 'contacts.show',
      component: ContactsShow,
    },
  ],
};
