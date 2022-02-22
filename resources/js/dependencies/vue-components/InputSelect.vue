// v1.2.0
<template>
  <div class="flex flex-col">
    <div>
      <span>{{ label }}</span>
      <span v-if="required" class="text-red-600">*</span>
    </div>

    <select
      class="rounded border-2 border-gray-200 focus:ring focus:outline-none p-2"
      v-bind="$attrs"
      :required="required"
      @change="onChange"
    >
      <slot></slot>
    </select>

    <a :href="footerhref">{{ footertext }}</a>

    <span class="text-red-600 italic">
      {{ error }}
    </span>
  </div>
</template>

<script>
export default {
  name: "input-select",
  props: {
    label: String,
    required: Boolean,
    error: String,
    footertext: String,
    footerhref: URL | String,
  },
  methods: {
    onChange(event) {
      this.$root.$emit("input-select", this.$attrs.name, event.target.value);
    },
  },
};
</script>
