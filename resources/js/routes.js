import ContactsCreate from './views/contacts/Create.vue';
import ContactsShow from './views/contacts/Show.vue';
import ContactsEdit from './views/contacts/Edit.vue';
import ContactsIndex from './views/contacts/Index.vue';

export default {
  mode: 'history',

  routes: [
    {
      path: '/',
      name: 'home',
      redirect: { name: 'contacts.index' },
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
    {
      path: '/contacts/:id/edit',
      name: 'contacts.edit',
      component: ContactsEdit,
    },
    {
      path: '/contacts',
      name: 'contacts.index',
      component: ContactsIndex,
    },
  ],
};
