<template>
    <div
        class="w-10 h-10 flex justify-center items-center border border-gray-300 rounded-full text-xl text-white bg-blue-400 leading-none shadow"
        :title="name"
    >
        {{ initials }}
    </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },

    default: {
      type: String,
      default: 'U',
    },
  },

  computed: {
    initials() {
      return this.name.match(/[A-Z]/g).slice(0, 2).join('') || this.default;
    },
  },
};
</script>
