require('./bootstrap');

//import { createApp, h } from 'vue'
//import { App, plugin } from '@inertiajs/inertia-vue3'
//Vue2
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

//Vuetify
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

Vue.use(plugin)

const el = document.getElementById('app')

//Progress indicator
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()

/*createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}`).default,
    })
}).use(plugin).mount(el)*/



//Vue 2
new Vue({
    vuetify: new Vuetify(),
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)
