// v1.0.0
<template>
  <a :href="currenthref" @click.prevent="scroll">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: "link-scroll",
  props: ["href", "backuphref", "offset"],
  data: function () {
    return {
      currenthref: this.href,
    };
  },
  mounted: function () {
    this.$nextTick(function () {
      // When page loads, smooth scroll to URL's hash with offset.
      if (location.hash == this.href) {
        this.scroll();
      } else {
        // If this.href doesn't exist, replace it with this.backuphref
        if (!document.querySelector(this.href)) {
          this.currenthref = this.backuphref;
        }
      }
    });
  },
  methods: {
    scroll() {
      if (document.querySelector(this.href)) {
        var elementPosition = document.querySelector(this.href).offsetTop;

        // If offset is set, use said offset.
        // If not, make it 0.
        var offset = isNaN(this.offset) == false ? this.offset : 0;

        window.scrollTo({
          top: elementPosition - offset,
          behavior: "smooth",
        });
      } else {
        // If href doesn't exist, go to backup href.
        window.location.href = this.backuphref;
      }
    },
  },
};
</script>
