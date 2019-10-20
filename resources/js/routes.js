import ContactsCreate from './views/contacts/Create.vue';
import ContactsShow from './views/contacts/Show.vue';
import ContactsEdit from './views/contacts/Edit.vue';
import ContactsIndex from './views/contacts/Index.vue';
import BirthdaysIndex from './views/birthdays/Index.vue';

export default {
  mode: 'history',

  routes: [
    {
      path: '/',
      name: 'home',
      redirect: { name: 'contacts.index' },
      meta: { title: 'Welcome' },
    },
    {
      path: '/contacts',
      name: 'contacts.index',
      component: ContactsIndex,
      meta: { title: 'Contacts' },
    },
    {
      path: '/contacts/create',
      name: 'contacts.create',
      component: ContactsCreate,
      meta: { title: 'Add New Contact' },
    },
    {
      path: '/contacts/:id',
      name: 'contacts.show',
      component: ContactsShow,
      meta: { title: 'Details for Contact' },
    },
    {
      path: '/contacts/:id/edit',
      name: 'contacts.edit',
      component: ContactsEdit,
      meta: { title: 'Edit Contact' },
    },
    {
      path: '/birthdays',
      name: 'birthdays.index',
      component: BirthdaysIndex,
      meta: { title: 'This Month\'s Birthdays' },
    },
  ],
};
