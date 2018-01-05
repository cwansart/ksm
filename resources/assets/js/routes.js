import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        alias: '/cats',
        component: require('./components/CatIndex')
    },
    {
        path: '/cats/create',
        component: require('./components/CatCreate')
    },
    {
        path: '/cats/present',
        component: require('./components/CatIndexPresent')
    },
    {
        path: '/cats/deceased',
        component: require('./components/CatIndexDeceased')
    },
    {
        path: '/cats/mediated',
        component: require('./components/CatIndexMediated')
    },
    {
        path: '/cats/in_care',
        component: require('./components/CatIndexInCare')
    },
    {
        name: 'catEdit',
        path: '/cats/:id/edit',
        component: require('./components/CatEdit')
    },
    {
        name: 'catMediate',
        path: '/cats/:id/mediate',
        component: require('./components/CatMediate')
    }
];

export default new VueRouter({
    routes
});