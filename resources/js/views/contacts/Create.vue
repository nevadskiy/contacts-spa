<template>
    <div>
        <form @submit.prevent="submit">
            <h1>Create contact</h1>

            <AppInput
                v-model="form.name"
                :errors="errors.name"
                name="name"
                label="Contact Name"
                placeholder="Contact name"
                class="mt-4"
            />

            <AppInput
                v-model="form.email"
                :errors="errors.email"
                name="email"
                type="email"
                label="Contact email"
                placeholder="example@email.com"
                class="mt-8"
            />

            <AppInput
                v-model="form.company"
                :errors="errors.company"
                name="company"
                label="Company"
                placeholder="Company"
                class="mt-8"
            />

            <AppInput
                v-model="form.birthday"
                :errors="errors.birthday"
                name="birthday"
                label="Birthday"
                placeholder="MM/DD/YYYY"
                class="mt-8"
            />

            <div class="flex items-center justify-end mt-2">
                <AppButton class="text-red-700 border hover:border-red-700">Cancel</AppButton>
                <AppButton class="ml-4 bg-blue-500 text-gray-100 hover:bg-blue-400">Add New Contact</AppButton>
            </div>
        </form>
    </div>
</template>

<script>
import AppInput from '../../components/AppInput.vue';
import AppButton from '../../components/AppButton.vue';

export default {
  components: {
    AppInput,
    AppButton,
  },

  data() {
    return {
      form: {
        name: '',
        email: '',
        company: '',
        birthday: '',
      },

      errors: {},
    };
  },

  methods: {
    submit() {
      window.axios.post('/api/contacts', this.form)
        .then((response) => {
          this.redirect(response.data.data);
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },

    redirect(contact) {
      this.$router.push({ name: 'contacts.show', params: { id: contact.id } });
    },
  },
};
</script>
