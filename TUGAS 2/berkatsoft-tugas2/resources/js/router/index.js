const Vue = require('vue').default;

// import VueRouter from 'vue-router'
import VueRouter from 'vue-router'
Vue.use(VueRouter);


import NotFound from '../pages/NotFoundComponent.vue'
import SalesOrder from '../pages/SalesOrderComponent.vue'
import Product from '../pages/ProductComponent.vue'
import NewProduct from '../pages/NewProductComponent.vue'

import Customer from '../pages/CustomerComponent.vue'


const routes = [
    {
        name: 'NewProduct',
        path: '/new-product',
        component : NewProduct
    },

    {
        name: 'Customer',
        path: '/customer/:id?',
        component : Customer
    },
    {
        name: 'CustomerEdit',
        path: '/customer/edit/:id',
        component : Customer
    },
    {
        name: 'Product',
        path: '/product/:id?',
        component : Product,
        props:true
    },
    // {
    //     path: '/product/edit/:id',
    //     component : Product
    // },
    {
        path: '/sales-order',
        component : SalesOrder
    },
    {
        path: '*',
        component : NotFound
    }
]

const router = new VueRouter({
    linkActiveClass:'active',
    mode:'history',
    routes
})

export default router
