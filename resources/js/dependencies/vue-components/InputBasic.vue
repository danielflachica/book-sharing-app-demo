// v1.2.0
<template>
  <div class="flex flex-col">
    <div>
      <span>{{ label }}</span>
      <span v-if="required != null" class="text-red-600">*</span>
    </div>

    <input
      class="rounded border-2 border-gray-200 focus:ring focus:outline-none p-2"
      v-bind="$attrs"
      :required="required"
    />

    <a :href="footerhref" target="_blank">{{ footertext }}</a>

    <span class="text-red-600 italic">
      {{ error }}
    </span>
  </div>
</template>

<script>
export default {
  name: "input-basic",
  props: ["label", "required", "accept", "error", "footertext", "footerhref"],
};
</script>
