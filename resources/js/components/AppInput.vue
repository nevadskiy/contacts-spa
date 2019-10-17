<template>
    <div>
        <label :for="name" class="text-blue-500 uppercase font-bold">{{ label }}</label>

        <input
            :id="name"
            :type="type"
            class="w-full py-2 text-gray-800 border-b border-gray-400 outline-none bg-transparent focus:border-blue-400"
            :placeholder="placeholder"
            :value="value"
            @input="update"
        >
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
  },

  methods: {
    update(event) {
      this.$emit('input', event.target.value);
    },
  },
};
</script>
