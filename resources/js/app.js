import './bootstrap';

window.Vue = require('vue')

Vue.component('example-component', require('./components/ExampleComponents').default)


const app = new Vue({
    el: '#app'
});