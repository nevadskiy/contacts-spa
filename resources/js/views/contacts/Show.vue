<template>
    <div>

    </div>
</template>

<script>
export default {
  data() {
    return {
      contact: null,
    };
  },

  created() {
    window.axios.get(`/api/contacts/${this.$route.params.id}`)
      .then((response) => {
        this.contact = response.data.data;
      })
      .catch((errors) => {
        console.log(errors);
      });
  },
};
</script>
