<template>
  <div class="flex flex-col bg-white shadow border relative">
    <options-dropdown 
      v-if="editable != null" 
      class="absolute top-2 right-2">
      <a v-if="show_route"
        class="options-dropdown-item"
        :href="show_route">
        View Book
      </a>
      <a v-if="edit_route" 
        class="options-dropdown-item"
        :href="edit_route">
        Edit Book
      </a>
      <confirm-button 
        v-if="delete_route"
        class="options-dropdown-item-danger"
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
      :src="cover_photo" 
      :alt="title">
    <img v-else 
      class="h-96 w-auto object-cover bg-gray-200"
      src="img/NoImageAvailable.jpg"
      alt="No Image Available">
    
    <div class="p-4">
      <div>
        Title: <span :class="textColor">{{ title }}</span>
      </div>
      <div>
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
    props:  {
      cover_photo: {
        type: String,
        required: true,
      },
      title: {
        type: String,
        required: true,
      },
      isbn: {
        type: String,
        required: true,
      },
      added_by: {
        type: String,
        required: false,
      },
      last_updated: {
        type: String,
        required: false,
      },
      editable: {
        type: Boolean,
        required: false,
      },
      csrf: {
        type: String,
        required: false,
      },
      delete_route: {
        type: String,
        required: false,
      },
      edit_route: {
        type: String,
        required: false,
      },
      show_route: {
        type: String,
        required: false,
      }
    },
    data() {
      return {
        textColor: 'text-primary',
      }
    },
  };
</script>
