import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NovoFornecedor from '../components/Fornecedor/NovoFornecedor.vue'
import FornecedorIndex from '../views/Fornecedor/FornecedorIndex.vue'
import Login from '../views/Usuario/Login.vue'
import DefaultLayout from '../components/DefaultLayout.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Login
  },
  {
    path: '/fornecedores',
    props: true,
    component: DefaultLayout,
    children: [
      {
        path: '',
        name: 'Fornecedor',
        component: FornecedorIndex,
        props: true,
      },
      {
        path: 'novo',
        name: 'Novo Fornecedor',
        component: NovoFornecedor,
        props: true,
      },
    ],
  },
  {
    path: '/fornecedores/cadastro',
    name: 'fornecedores-cadastro',
    component: NovoFornecedor,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
