import VueRouter from 'vue-router'
import routes from './routes.js'

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active',
})
