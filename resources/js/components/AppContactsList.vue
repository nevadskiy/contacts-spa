<template>
    <div>
        <AppLoader v-if="loading" />

        <div v-else>
            <div v-if="contacts.length === 0">
                <slot name="empty">
                    <p>No contacts yet. <router-link to="{ name: 'contacts.create' }" class="text-blue-500">Get Started</router-link></p>
                </slot>
            </div>

            <AppContact
                v-for="contact in contacts"
                :key="contact.id"
                :contact="contact"
                class="border-b last:border-b-0 border-gray-200"
            />
        </div>
    </div>
</template>

<script>
import AppLoader from './AppLoader.vue';
import AppContact from './AppContact.vue';

export default {
  components: {
    AppLoader,
    AppContact,
  },

  props: {
    endpoint: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      loading: true,
      contacts: true,
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      window.axios.get(this.endpoint)
        .then((response) => {
          this.contacts = response.data.data;
        })
        .catch((errors) => {
          console.log(errors);
          alert('Unable to fetch contacts.');
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
