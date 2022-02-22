// v1.0.0
<template>
  <div v-if="isVisible">
    <div class="fixed w-screen h-screen bg-black opacity-50 z-30"></div>
    <div class="fixed flex justify-center items-center h-full w-full z-40">
      <div class="bg-white rounded w-96" v-click-outside="closeModal">
        <div class="flex flex-col h-full">
          <div class="flex-grow pt-8 px-8">
            <div class="flex flex-col h-full">
              <span class="font-bold">
                {{ title }}
              </span>
              <span class="mt-2">
                {{ description }}
              </span>
            </div>
          </div>
          <div class="flex justify-end space-x-2 p-4">
            <a class="btn-text-dark cursor-pointer" @click="closeModal">
              Cancel
            </a>
            <form :action="this.href" method="POST">
              <input type="hidden" name="_token" :value="this.csrf" />
              <input type="hidden" name="_method" :value="this.method" />
              <input type="hidden" name="redirect" :value="this.redirect" />
              <button :class="this.submitButtonClass">
                {{ submitButtonText }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vClickOutside from "v-click-outside";

export default {
  name: "confirmation-modal",
  directives: {
    clickOutside: vClickOutside.directive,
  },
  data: () => ({
    isVisible: false,
    title: "Are you sure?",
    description: "This action is irreversable.",
    submitButtonText: "Delete",
    submitButtonClass: "btn-danger",
    href: "",
    csrf: "",
    method: "POST",
    redirect: "",
  }),
  computed: {},
  mounted() {
    this.$root.$on(
      "confirmation-modal",
      (
        href,
        csrf,
        method,
        redirect,
        title,
        description,
        submitButtonText,
        submitButtonClass
      ) => {
        this.isVisible = true;
        this.href = href;
        this.csrf = csrf;
        this.method = method;
        this.redirect = redirect ?? "";
        this.title = title ?? "Are you sure?";
        this.description = description ?? "This action is irreversable.";
        this.submitButtonText = submitButtonText ?? "Delete";
        this.submitButtonClass = submitButtonClass ?? "btn-danger";
      }
    );
  },
  methods: {
    closeModal() {
      this.isVisible = false;
    },
  },
};
</script>
