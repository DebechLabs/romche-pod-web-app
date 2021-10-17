require('./bootstrap');


import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icon from '@/Components/Icon'
import VueSweetalert2 from 'vue-sweetalert2';
import vSelect from 'vue-select'


// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-select/dist/vue-select.css';

window.Vue = require('vue');

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        window.addEventListener('popstate', ()=>{
            this.$page.popstate = true
        })
        const vueApp = createApp({ render: () => h(app, props) });
        vueApp.config.globalProperties.$routes = route
        vueApp
            .component("Link", Link)
            .component("Head", Head)
            .component("Icon", Icon)
            .component("v-select", vSelect)
        vueApp
            .use(plugin)
            .use(VueSweetalert2)
            .mixin({ methods: { route } })
            .mount(el);

        return vueApp
    },
});

InertiaProgress.init({ color: '#4B5563' });
