<template>
  <div v-if="isVisible">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "hide-at-y",

  props: ["y", "visible"],

  computed: {},

  data: function () {
    return {
      isVisible: true,
    };
  },

  mounted: function () {
    this.$nextTick(function () {
      this.init();
    });

    this.isVisible = false;
    if (this.visible == true || this.visible == null) {
      this.isVisible = true;
    }
  },

  methods: {
    init: function () {
      $(document).bind(
        "scroll",
        function () {
          // Show button if user scrolled over 250px
          if ($(document).scrollTop() > this.y) {
            this.isVisible = this.visible;
          } else {
            this.isVisible = !this.visible;
          }
        }.bind(this)
      );
    },
  },
};
</script>
