// v1.0.0
<template>
  <a @click="openConfirmationModal" :class="{ 'cursor-pointer': isActive }">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: "confirm-button",
  props: [
    "href",
    "csrf",
    "method",
    "redirect",
    "title",
    "description",
    "submit-button-text",
    "submit-button-class",
    "disabled",
  ],
  data() {
    return {
      isActive: !this.disabled,
    };
  },
  methods: {
    openConfirmationModal() {
      if (this.isActive) {
        this.$root.$emit(
          "confirmation-modal",
          this.href,
          this.csrf,
          this.method,
          this.redirect,
          this.title,
          this.description,
          this.submitButtonText,
          this.submitButtonClass
        );
      }
    },
  },
};
</script>
