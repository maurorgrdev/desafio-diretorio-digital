import { createRouter, createWebHashHistory } from 'vue-router'

import FornecedorCreateView from '@/views/Fornecedor/FornecedorCreateView'
import FornecedorUpdateView from '@/views/Fornecedor/FornecedorUpdateView'
import FornecedorIndex from '@/views/Fornecedor/FornecedorIndex.vue'
import Login from '@/views/Usuario/Login.vue'
import DefaultLayout from '@/components/DefaultLayout.vue'

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
        component: FornecedorCreateView,
        props: true,
      },
      {
        path: 'edita',
        name: 'Atualiza Fornecedor',
        component: FornecedorUpdateView,
        props: true,
      },
    ],
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
