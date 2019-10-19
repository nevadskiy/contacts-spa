<template>
    <AppContactsList endpoint="/api/contacts" />
</template>

<script>
import AppContactsList from '../../components/AppContactsList.vue';

export default {
  components: {
    AppContactsList,
  },
};
</script>
