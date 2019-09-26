const
    $ = require('jquery');
    Vue = require('vue');

Vue.component('todo-item', {
    template: '<li>This is a todo</li>'
});

let app = new Vue();