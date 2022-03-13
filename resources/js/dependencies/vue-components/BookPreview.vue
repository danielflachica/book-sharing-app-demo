<template>
  <div class="flex flex-col bg-white shadow border relative">
    <options-dropdown 
      v-if="editable != null" 
      class="absolute top-2 right-2">
      <a class="options-dropdown-item"
        :href="edit_route">
        Edit Book
      </a>
      <confirm-button class="options-dropdown-item-danger"
        :title="'Are you sure you want to delete '+title+'?'"
        submit-button-text="Delete Book"
        :href="delete_route"
        :csrf="csrf"
        method="DELETE">
        Delete Book
      </confirm-button>
    </options-dropdown>

    <img v-if="cover_photo" 
      class="h-96 w-auto object-cover bg-gray-200" 
      :src="cover_photo_path" 
      :alt="title">
    <img v-else 
      class="h-96 w-auto object-cover bg-gray-200"
      src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png"
      alt="No Image Available">
    
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
    props: [
      "cover_photo",
      "title",
      "isbn",
      "year",
      "added_by",
      "last_updated",
      "editable",
      "csrf",
      "delete_route",
      "edit_route",
    ],
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
