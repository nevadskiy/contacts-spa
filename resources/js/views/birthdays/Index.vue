<template>
    <AppContactsList endpoint="/api/birthdays">
        <template v-slot:empty>
            <p>No birthdays this month.</p>
        </template>
    </AppContactsList>
</template>

<script>
import AppContactsList from '../../components/AppContactsList.vue';

export default {
  components: {
    AppContactsList,
  },
};
</script>
