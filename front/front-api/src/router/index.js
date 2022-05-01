import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SalesBySeller from '../views/SalesBySellerView.vue'
import AddSale from '../views/AddSaleView.vue'
import AddSeller from '../views/AddSellerView.vue'



const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/sales/seller/:id',
    name: 'salesBySeller',
    component: SalesBySeller
  },
  {
    path: '/sale/add',
    name: 'addSale',
    component: AddSale
  },
  {
    path: '/seller/add',
    name: 'addSeller',
    component: AddSeller
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
