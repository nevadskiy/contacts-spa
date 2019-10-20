<template>
    <div class="relative flex items-center">
        <svg class="ml-3 w-4 h-4 absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52.966 52.966">
            <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19S32.459,40,21.983,40z"/>
        </svg>

        <input
            :id="id"
            :name="name"
            v-model="query"
            :placeholder="placeholder"
            class="pl-10 pr-3 py-1 rounded-full border-2 text-gray-800 border-gray-400 bg-gray-100 focus:bg-white focus:outline-none focus:border-blue-500 focus:shadow"
            type="text"
        >
    </div>
</template>

<script>
import _ from 'lodash';

export default {
  props: {
    id: {
      type: String,
      default: 'search',
    },

    name: {
      type: String,
      default: 'query',
    },

    placeholder: {
      type: String,
      default: 'Search...',
    },
  },

  watch: {
    query(currentValue, previousValue) {
      if (currentValue.length >= 1) {
        this.searchDebounced();
      }
    },
  },

  data() {
    return {
      query: '',
    };
  },

  created() {
    this.searchDebounced = _.debounce(this.search, 300);
  },

  methods: {
    search() {
      window.axios.get('/api/search', {
        params: {
          query: this.query,
        },
      })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
