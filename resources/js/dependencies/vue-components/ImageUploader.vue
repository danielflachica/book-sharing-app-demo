<template>
  <div>
    <p>{{ label }}</p>

    <div class="flex">
      <button :class="imageType == 'file' ? activeTab : inactiveTab"
        type="button"
        @click="setImageType('file')">
        Upload a Photo
      </button>
      <button :class="imageType == 'url' ? activeTab : inactiveTab"
        type="button"
        @click="setImageType('url')">
        Paste from URL
      </button>
    </div>

    <div class="flex border-2 border-gray-200 p-2">
      <input-basic 
        v-if="imageType == 'file'"
        class="w-full"
        type="file"
        :name="name"
        :error="error"
        :footertext="helpMsg + ' Max size: 1,000KB.'">
      </input-basic>

      <div class="w-full" v-if="imageType == 'url'"> 
        <input-basic 
          class="w-full"
          type="url"
          :name="name"
          pattern="https?://.+[.jpg, .jpeg, .png, .JPG, .JPEG, .PNG]$"
          placeholder="Paste a valid image URL"
          :error="error"
          :footertext="helpMsg + ' Please ensure that you have proper access rights.'">
        </input-basic>
        <input-basic
          class="hidden"
          type="hidden"
          name="has_url"
          value="1">
        </input-basic>
      </div>
    </div>
  </div>
</template>

<script>
import InputBasic from './InputBasic.vue';
  export default {
  components: { InputBasic },
    name: "image-uploader",
    props: ['label', 'name', 'error'],
    data() {
      return {
        imageType: 'file',
        activeTab: 'border p-2 text-primary bg-gray-100',
        inactiveTab: 'border p-2 text-gray-500 hover:bg-gray-100',
        helpMsg: 'Choose a photo that will help people recognize your book.',
      }
    },
    computed: {
    },
    methods: {
      setImageType(imageType) {
        this.imageType = imageType;
      }
    },
  }
</script>
