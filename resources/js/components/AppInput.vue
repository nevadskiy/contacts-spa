<template>
    <div>
        <label :for="name" class="text-blue-500 uppercase font-bold">{{ label }}</label>

        <input
            :id="name"
            :type="type"
            :placeholder="placeholder"
            :value="value"
            class="w-full py-2 text-gray-800 border-b outline-none bg-transparent focus:border-blue-400"
            :class="inputClasses"
            @input="update"
        >

        <span v-show="shouldShowErrors" class="text-red-600 text-sm">{{ errors[0] }}</span>
    </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },

    label: {
      type: String,
      required: true,
    },

    placeholder: {
      type: String,
      default: '',
    },

    value: {
      default: null,
    },

    type: {
      type: String,
      default: 'text',
    },

    errors: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      isErrorsHidden: false,
    };
  },

  computed: {
    shouldShowErrors() {
      return !this.isErrorsHidden && this.hasErrors;
    },

    hasErrors() {
      return this.errors.length;
    },

    inputClasses() {
      return {
        'border-gray-400': !this.shouldShowErrors,
        'border-red-600': this.shouldShowErrors,
      };
    },
  },

  watch: {
    errors() {
      this.showErrors();
    },
  },

  methods: {
    update(event) {
      this.hideErrors();
      this.$emit('input', event.target.value);
    },

    hideErrors() {
      this.isErrorsHidden = true;
    },

    showErrors() {
      this.isErrorsHidden = false;
    },
  },
};
</script>
