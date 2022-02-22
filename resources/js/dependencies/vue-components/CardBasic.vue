// v1.0.0
<template>
  <div
    class="
      bg-white
      overflow-hidden
      shadow-lg
      rounded
      overflow-x-auto
      dark:bg-gray-800
    "
  >
    <div class="flex p-4 border-b" v-if="title">
      <div class="flex-grow">
        <h3 class="text-lg leading-6 font-medium">
          <a :href="href" v-if="href">
            {{ title }}
          </a>
          <span v-else>
            {{ title }}
          </span>
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500" v-if="subtitle">
          {{ subtitle }}
        </p>
      </div>
      <div>
        <slot name="options"></slot>
      </div>
    </div>
    <div class="p-4 border-b" v-if="hasSlotHeader">
      <slot name="header"></slot>
    </div>
    <div class="" v-if="hasSlotNoBorder">
      <slot name="noborder"></slot>
    </div>
    <div class="p-4" v-if="hasSlotData">
      <slot></slot>
    </div>
    <div class="p-4 border-t" v-if="hasSlotFooter">
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "card-basic",
  props: ["title", "subtitle", "href", "noBorder"],
  computed: {
    hasSlotData() {
      return !!this.$slots.default;
    },
    hasSlotFooter() {
      return !!this.$slots.footer;
    },
    hasSlotHeader() {
      return !!this.$slots.header;
    },
    hasSlotImage() {
      return !!this.$slots.image;
    },
    hasSlotNoBorder() {
      return !!this.$slots.noborder;
    },
  },
};
</script>
