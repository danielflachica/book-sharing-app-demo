// v1.0.0
<template>
  <button type="submit" class="btn btn-primary float-right">
    <i class="material-icons material-icons-outlined md-18" v-if="icon">
      {{ icon }}
    </i>
    <span v-if="text">{{ text }}</span>
    <span v-else>Submit</span>
  </button>
</template>

<script>
export default {
  name: "button-submit",
  props: ["text", "icon"],
  computed: {},
};
</script>
