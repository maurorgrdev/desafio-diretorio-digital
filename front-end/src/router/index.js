import { createRouter, createWebHashHistory } from 'vue-router'

import FornecedorCreateView from '@/views/Fornecedor/FornecedorCreateView'
import FornecedorUpdateView from '@/views/Fornecedor/FornecedorUpdateView'
import FornecedorShowView from '@/views/Fornecedor/FornecedorShowView'
import FornecedorIndex from '@/views/Fornecedor/FornecedorIndex.vue'
import Login from '@/views/Usuario/Login.vue'
import DefaultLayout from '@/components/DefaultLayout.vue'
import { useUsuarioStore } from '@/store/user'

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
    meta : {
      auth: true
    },
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
        path: 'edita/:id',
        name: 'Atualiza Fornecedor',
        component: FornecedorUpdateView,
        props: true,
      },
      {
        path: 'visualiza/:id',
        name: 'Visualiza Fornecedor',
        component: FornecedorShowView,
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

router.beforeEach(async (to, from, next) => {
  if(to.meta?.auth){
    const store = useUsuarioStore()

    if(store.token_user){
      const isAuthneticated = await store.verifyToken();

      if(isAuthneticated){
        next();
      } else {
        next({name: 'login'})
      }
    } else {
      next({name: 'login'})
    }
  } else {
    next()
  }
})

export default router
