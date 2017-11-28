import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        alias: '/cats',
        component: require('./components/CatIndex'),
        query: {
            page: 1,
            hightlight: null,
        }
    },
    {
        path: '/cats/create',
        component: require('./components/CatCreate')
    },
    {
        name: 'catEdit',
        path: '/cats/:catId/edit',
        component: require('./components/CatEdit')
    }
]

export default new VueRouter({
    routes
})