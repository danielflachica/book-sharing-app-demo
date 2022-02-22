// v1.0.0
<template>
  <a
    id="scroll"
    class="
      fixed
      w-12
      h-12
      bg-black
      flex
      justify-center
      items-center
      hover:bg-primary
      cursor-pointer
      active:bg-primary-light
      z-50
      rounded
    "
    v-if="isVisible"
    @click="scrollToTop"
    style="bottom: 16px; right: 16px"
  >
    <i class="material-icons text-white">keyboard_arrow_up</i>
  </a>
</template>

<script>
export default {
  name: "scroll-to-top",

  data: function () {
    return {
      isVisible: false,
    };
  },

  created() {
    window.addEventListener("scroll", this.handleScroll);
  },

  methods: {
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },
    handleScroll(event) {
      // console.log(event.path[1].scrollY);
      if (event.path[1].scrollY > 600) {
        this.isVisible = true;
      } else {
        this.isVisible = false;
      }
    },
  },
};
</script>
