// v1.0.0
<template>
  <option v-bind:value="value" v-bind:selected="selected" v-if="visible">
    <slot></slot>
  </option>
</template>

<script>
export default {
  name: "input-select-option",
  props: {
    value: String,
    selected: Boolean,
    parentname: String,
    parentvalue: String,
    none: Boolean,
  },
  data() {
    return {
      visible: true,
    };
  },
  mounted() {
    this.$root.$on("input-select", (parentname, value) => {
      if (this.parentname === parentname) {
        if (this.parentvalue === value || value === "") {
          this.makeVisible();
        } else {
          this.makeInvisible();
        }
      }
    });
  },
  methods: {
    makeVisible() {
      this.visible = true;
    },
    makeInvisible() {
      if (!this.none) {
        this.visible = false;
      }
    },
  },
};
</script>
