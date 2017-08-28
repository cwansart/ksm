import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        alias: '/cats',
        component: require('./components/CatIndex'),
        query: {
            page: 1
        }
    },
    {
        path: '/cats/create',
        component: require('./components/CatCreate')
    }
]

export default new VueRouter({
    routes
})