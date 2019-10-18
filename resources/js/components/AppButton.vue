<template>
    <component
        :is="tag"
        :to="to"
        :class="classes"
        class="inline-block px-4 rounded leading-none"
    >
        <slot></slot>
    </component>
</template>

<script>
export default {
  props: {
    to: {
      type: [String, Object],
      default: null,
    },

    size: {
      type: String,
      default: 'md',
    },

    color: {
      type: String,
      default: null,
    },
  },

  data() {
    return {

    };
  },

  computed: {
    tag() {
      if (this.to) {
        return 'router-link';
      }

      return 'button';
    },

    classes() {
      return [
        ...this.sizeClasses,
      ];
    },

    sizeClasses() {
      return [
        this.size === 'sm' ? 'py-2 text-sm font-bold' : '',
        this.size === 'md' ? 'py-3' : '',
      ];
    },
  },

  watch: {

  },

  methods: {

  },
};
</script>
