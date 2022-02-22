<template>
  <div class="flex flex-col bg-white shadow border">
    <img v-if="cover_photo" class="h-96 w-auto object-cover bg-gray-200" :src="cover_photo_path" :alt="title">
    <div class="p-4">
      <div v-if="title">
        Title: <span :class="textColor">{{ title }}</span>
      </div>
      <div v-if="isbn">
        ISBN-13: <span :class="textColor">{{ isbn }}</span>
      </div>
      <div v-if="year">
        Year Published: <span :class="textColor">{{ year }}</span>
      </div>
      <div v-if="added_by">
        Added By: <span :class="textColor">{{ added_by }}</span>
      </div>
      <div v-if="last_updated">
        Last Updated: <span :class="textColor">{{ last_updated }}</span>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "book-preview",
    props: ["cover_photo", "title", "isbn", "year", "added_by", "last_updated"],
    data() {
      return {
        textColor: 'text-primary',
      }
    },
    computed: {
      cover_photo_path() {
        var path = this.cover_photo;
        let trimmedPath = path.substring(path.indexOf('/storage/') + '/storage/'.length);

        // from URL
        if (trimmedPath.toLowerCase().includes('http://') || trimmedPath.toLowerCase().includes('https://')) {
          return trimmedPath;
        }

        // from Storage
        return path;
      },
    },
  };
</script>
