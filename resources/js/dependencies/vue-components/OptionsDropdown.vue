// v1.0.3
<template>
  <div class="static inline-block">
    <button
      ref="button"
      type="button"
      class="
        inline-flex
        justify-center
        w-full
        rounded-full
        border border-gray-300
        shadow-sm
        p-1
        bg-white
        text-sm
        font-medium
        text-gray-700
        hover:bg-gray-50
        focus:outline-none
        focus:ring-2
        focus:ring-offset-2
        focus:ring-offset-gray-100
        focus:ring-indigo-500
      "
      aria-expanded="true"
      aria-haspopup="true"
      @click="toggleDropdown"
    >
      <span class="material-icons">{{ icon ? icon : "more_vert" }}</span>
    </button>

    <!--
      Dropdown menu, show/hide based on menu state.

      Entering: "transition ease-out duration-100"
        From: "transform opacity-0 scale-95"
        To: "transform opacity-100 scale-100"
      Leaving: "transition ease-in duration-75"
        From: "transform opacity-100 scale-100"
        To: "transform opacity-0 scale-95"
    -->

    <!-- Mobile View -->
    <div
      class="fixed inset-0 w-screen h-screen bg-black opacity-50 sm:hidden z-30"
      v-if="isVisible"
    ></div>
    <div
      class="
        sm:hidden
        fixed
        bottom-0
        left-0
        mt-2
        w-screen
        rounded-md
        shadow-lg
        bg-white
        ring-1 ring-black ring-opacity-5
        focus:outline-none
        overflow-hidden
        z-40
      "
      role="menu"
      aria-orientation="vertical"
      aria-labelledby="options-menu"
      v-if="isVisible"
      @click="toggleDropdown"
      v-click-outside="toggleDropdown"
    >
      <div role="none" class="divide-y divide-gray-200">
        <slot></slot>
      </div>
    </div>

    <!-- Desktop Size -->
    <div
      ref="dropdown"
      class="
        hidden
        sm:inline-flex
        fixed
        w-48
        rounded-md
        shadow-lg
        bg-white
        ring-1 ring-black ring-opacity-5
        focus:outline-none
        overflow-hidden
        z-40
      "
      role="menu"
      aria-orientation="vertical"
      aria-labelledby="options-menu"
      v-if="isVisible"
      @click="toggleDropdown"
      v-bind:style="{
        left: dropdownLeft,
        top: dropdownTop,
      }"
    >
      <div class="w-full">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
import vClickOutside from "v-click-outside";

export default {
  name: "options-dropdown",
  props: ["icon"],
  directives: {
    clickOutside: vClickOutside.directive,
  },
  created() {
    window.addEventListener("scroll", this.handleScroll);
    window.addEventListener("resize", this.handleScroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
    window.removeEventListener("resize", this.handleScroll);
  },
  data: () => ({
    isVisible: false,
    dropdownLeft: "200px",
    dropdownTop: "200px",
  }),
  computed: {
    computedDropdownLeft: function () {
      return this.dropdownLeft;
    },
    computedDropdownTop: function () {
      return this.dropdownTop;
    },
  },
  methods: {
    toggleDropdown() {
      // Don't toggle if slot is empty
      if (this.$slots.default != null) {
        this.isVisible = !this.isVisible;
        if (this.isVisible) {
          this.moveDropdown();
        }
      }
    },
    getOffset(element) {
      const rect = element.getBoundingClientRect();
      return {
        left: rect.left - 160,
        top: rect.top + 42,
      };
    },
    moveDropdown() {
      const position = this.getOffset(this.$refs.button);
      if (this.isVisible) {
        this.dropdownLeft = position.left + "px";
        this.dropdownTop = position.top + "px";
      }
    },
    // Move dropdown if user scrolls
    handleScroll() {
      if (this.isVisible) {
        this.moveDropdown();
      }
    },
  },
};
</script>
