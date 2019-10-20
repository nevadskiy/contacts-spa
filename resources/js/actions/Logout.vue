<template>
    <h1>Logging out...</h1>
</template>

<script>
export default {
  created() {
    window.axios.post('/logout')
      .finally(() => {
        window.location.href = '/login';
      });
  },
};
</script>

<style scoped>

</style>
