import { defineStore } from 'pinia'
import api from "../axios"

export const useFornecedorStore = defineStore("fornecedor", {
    state: () => ({
        fornecedores: [],
    }),
    getters: {
      getFornecedores(state){
          return state.fornecedores
        }
    },
    actions: {
      async fetchFornecedores() {
        try {
          console.log('teste');
          const data = await api.get('/fornecedores')
          this.fornecedores = data.data
        }
          catch (error) {
            alert(error)
            console.log(error)
        }
      },

      async addFornecedor(data){
        try {
          await api.post('/fornecedores', data);
        } catch (error) {
          alert(error)
          console.log(error)
        }
      }
    },
  });