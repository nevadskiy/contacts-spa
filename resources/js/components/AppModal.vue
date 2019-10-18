<template>
    <transition name="modal" appear>
        <div
            class="fixed z-50 inset-0 flex justify-center items-center bg-semi-50"
            @click="close"
        >
            <div class="modal max-w-lg w-full bg-gray-100 rounded shadow-lg p-8 mb-64">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
  methods: {
    close() {
      this.$emit('close');
    },
  },
};
</script>

<style>
    .bg-semi-50 {
        background-color: rgba(0, 0, 0, 0.50);
    }

    .modal-enter-active,
    .modal-leave-active {
        transition: opacity 200ms ease;
    }

    .modal-enter-active .modal,
    .modal-leave-active .modal {
        transition: transform 150ms ease;
    }

    .modal-enter,
    .modal-leave-to {
        opacity: 0;
    }

    .modal-enter .modal,
    .modal-leave-to .modal {
        transform: scale(1.1);
    }
</style>
