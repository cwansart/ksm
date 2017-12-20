import VueRouter from 'vue-router'

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
        component: require('./components/CatPresent')
    },
    {
        name: 'catEdit',
        path: '/cats/:id/edit',
        component: require('./components/CatEdit')
    }
]

export default new VueRouter({
    routes
})