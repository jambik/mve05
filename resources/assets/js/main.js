var Vue = require('vue');

import FirstComponent from './components/FirstComponent.vue';

new Vue({
    el: '#app',

    components: {
        FirstComponent: FirstComponent,
    },

    ready() {
        console.log('Vue and Vueify all set to go!');
    }
});