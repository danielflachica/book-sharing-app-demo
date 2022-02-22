// window.Vue = require('vue');

import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('button-submit', require('./vue-components/ButtonSubmit.vue').default);
Vue.component('card-basic', require('./vue-components/CardBasic.vue').default);
Vue.component('link-scroll', require('./vue-components/LinkScroll.vue').default);
Vue.component('options-dropdown', require('./vue-components/OptionsDropdown.vue').default);
Vue.component('scroll-to-top', require('./vue-components/ScrollToTop.vue').default);
Vue.component('select-dropdown', require('./vue-components/SelectDropdown.vue').default);
Vue.component('hide-at-y', require('./vue-components/HideAtY.vue').default);
Vue.component('input-basic', require('./vue-components/InputBasic.vue').default);
Vue.component('input-select', require('./vue-components/InputSelect.vue').default);
Vue.component('input-select-option', require('./vue-components/InputSelectOption.vue').default);
Vue.component('input-textarea', require('./vue-components/InputTextarea.vue').default);
Vue.component('confirmation-modal', require('./vue-components/ConfirmationModal.vue').default);
Vue.component('confirm-button', require('./vue-components/ConfirmButton.vue').default);
Vue.component('get-requester', require('./vue-components/GetRequester.vue').default);
Vue.component('book-preview', require('./vue-components/BookPreview.vue').default);
Vue.component('image-uploader', require('./vue-components/ImageUploader.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
