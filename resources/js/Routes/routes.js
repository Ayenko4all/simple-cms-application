
let routes = [
    {
        path: '/',
        name: 'redirect',
        redirect: '/clients'
    },
    { path: '/clients', component: require('../Pages/Client/index.vue').default},

    { path: '/registration', component: require('../Pages/Client/create.vue').default},

    {
        path: '/client/:id',
        name: 'Profile',
        component: require('../Pages/Client/show.vue').default
    },


];

export default routes


