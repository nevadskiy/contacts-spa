<template>
    <div>
        <AppLoader v-if="loading" />

        <div v-else>
            <div class="flex justify-between">
                <AppBackButton />

                <div>
                    <AppButton
                        :to="{ name: 'contacts.edit', params: { id: contact.id } }"
                        class="border border-green-500 text-green-500"
                        size="sm"
                    >
                        Edit
                    </AppButton>

                    <AppButton
                        class="ml-2 border border-red-500 text-red-500"
                        size="sm"
                        @click="askDelete"
                    >
                        Delete
                    </AppButton>

                    <AppModal
                        v-if="isDeleteWindowShown"
                        @close="cancelDelete"
                    >
                        <h5 class="text-gray-800 text-xl text-center">
                            Are you sure you want to delete this record?
                        </h5>

                        <div class="mt-6 flex justify-center items-center">
                            <AppButton
                                class="text-blue-500"
                                @click="cancelDelete"
                            >
                                Cancel
                            </AppButton>

                            <AppButton
                                class="ml-4 bg-red-500 text-white hover:bg-red-700"
                                @click="confirmDelete"
                            >
                                Delete
                            </AppButton>
                        </div>
                    </AppModal>
                </div>
            </div>

            <div class="mt-6 flex items-center">
                <AppAvatar :name="contact.name"/>
                <span class="pl-5 text-xl">{{ contact.name }}</span>
            </div>

            <div class="mt-8">
                <div>
                    <div class="text-gray-600 font-bold uppercase font-sm">Contact</div>
                    <span class="mt-2 text-blue-400">{{ contact.email }}</span>
                </div>

                <div class="mt-6">
                    <div class="text-gray-600 font-bold uppercase font-sm">Company</div>
                    <span class="mt-2 text-blue-400">{{ contact.company }}</span>
                </div>

                <div class="mt-6">
                    <div class="text-gray-600 font-bold uppercase font-sm">Birthday</div>
                    <span class="mt-2 text-blue-400">{{ contact.birthday }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppButton from '../../components/AppButton.vue';
import AppAvatar from '../../components/AppAvatar.vue';
import AppLoader from '../../components/AppLoader.vue';
import AppModal from '../../components/AppModal.vue';
import AppBackButton from '../../components/AppBackButton.vue';

export default {
  components: {
    AppButton,
    AppAvatar,
    AppLoader,
    AppModal,
    AppBackButton,
  },

  data() {
    return {
      loading: true,
      contact: null,
      isDeleteWindowShown: false,
    };
  },

  watch: {
    $route: {
      immediate: true,
      handler() {
        this.fetch();
      },
    },
  },

  methods: {
    fetch() {
      window.axios.get(`/api/contacts/${this.$route.params.id}`)
        .then((response) => {
          this.contact = response.data.data;
        })
        .catch((errors) => {
          console.log(errors);
        })
        .finally(() => {
          this.loading = false;
        });
    },

    askDelete() {
      this.isDeleteWindowShown = true;
    },

    cancelDelete() {
      this.isDeleteWindowShown = false;
    },

    confirmDelete() {
      window.axios.delete(`/api/contacts/${this.contact.id}`)
        .then(() => {
          this.$router.push({ name: 'contacts.index' });
        })
        .catch(() => {
          alert('Internal Error. Unable to delete the contact.');
        });
    },
  },
};
</script>
