// v1.0.0
<template>
  <span>
    {{ result }}
  </span>
</template>

<script>
const axios = require("axios");
export default {
  name: "get-requester",
  props: ["url"],
  data: () => ({
    result: "",
  }),
  mounted() {
    axios.get(this.url).then((response) => {
      console.log(response);
      this.result = response.data;
    });
  },
};
</script>
