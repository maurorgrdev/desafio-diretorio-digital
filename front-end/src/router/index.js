import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NovoFornecedor from '../components/Fornecedor/NovoFornecedor.vue'
import FornecedorIndex from '../views/Fornecedor/FornecedorIndex.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  { 
    path: '/fornecedores/cadastro',
    name: 'Fornecedores-cadastro',
    component: NovoFornecedor,
  },
  {
    path: '/fornecedores',
    name: 'Fornecedores',
    component: FornecedorIndex,
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
