require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icon from '@/Components/Icon'
window.Vue = require('vue');

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const vueApp = createApp({ render: () => h(app, props) });
        vueApp.config.globalProperties.$routes = route
        vueApp
            .component("Link", Link)
            .component("Head", Head)
            .component("Icon", Icon)
        vueApp
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);

        return vueApp
    },
});

InertiaProgress.init({ color: '#4B5563' });
