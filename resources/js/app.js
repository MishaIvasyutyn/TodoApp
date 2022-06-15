import MainComponent from "./components/MainComponent";

require('./bootstrap');

import {createApp}  from "vue";
const  app = createApp({})
app.component('main-component',MainComponent)
app.mount('#app')

