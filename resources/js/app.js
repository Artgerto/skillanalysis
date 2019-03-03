
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('trumbowyg');
require('trumbowyg/dist/trumbowyg.min.js');
require('trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js');
require('jquery-resizable-dom');
require('trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.js');
//require('../js/mathimg/trumbowyg.mathimg.js');
require('trumbowyg/dist/plugins/table/trumbowyg.table.js');
//require('quill/dist/quill.min.js');

import Vue from 'vue';
import VueMaterial from 'vue-material';

window.Vue = require('vue');
Vue.use(VueMaterial);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('resume-form', require('./components/ResumeForm.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
