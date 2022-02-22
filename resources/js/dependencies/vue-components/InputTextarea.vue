// v1.2.0
<template>
  <div class="flex flex-col">
    <div>
      <span>{{ label }}</span>
      <span v-if="required != null" class="text-red-600">*</span>
    </div>

    <textarea
      class="rounded border-2 border-gray-200 focus:ring focus:outline-none p-2"
      v-bind="$attrs"
      :required="required"
    ></textarea>

    <a :href="footerhref">{{ footertext }}</a>

    <span class="text-red-600 italic">
      {{ error }}
    </span>
  </div>
</template>

<script>
export default {
  name: "input-textarea",
  props: ["label", "required", "error", "footertext", "footerhref"],
};
</script>
