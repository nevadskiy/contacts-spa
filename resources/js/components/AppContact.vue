<template>
    <router-link
        :to="{ name: 'contacts.show', params: { id: contact.data.id } }"
        class="flex items-center py-3 px-2 hover:bg-gray-200"
    >
        <AppAvatar :name="contact.data.name" />

        <div class="ml-4">
            <div class="text-blue-400 font-bold">{{ contact.data.name }}</div>
            <div class="text-gray-600">{{ contact.data.company }}</div>
        </div>
    </router-link>
</template>

<script>
import AppAvatar from './AppAvatar.vue';

export default {
  components: {
    AppAvatar,
  },

  props: {
    contact: {
      type: Object,
      required: true,
    },
  },
};
</script>
