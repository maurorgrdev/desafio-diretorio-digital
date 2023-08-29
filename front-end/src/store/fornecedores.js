import { defineStore } from 'pinia'
import api from "../axios"

export const useFornecedorStore = defineStore("fornecedor", {
    state: () => ({
        fornecedores: [],
    }),
    getters: {
      getFornecedores(state){
        return state.fornecedores
      },

      getFornecedoresToTable(state){
        console.log(state.fornecedores);
        return state.fornecedores.map((fornecedor) => {
          const fornecedorTemp = {
            codigo: fornecedor.codigo,
            nome: fornecedor.empresa,
            email: fornecedor.email,
            cnpj: fornecedor.cnpj,
            atuacao: fornecedor.atuacao,
          };

          return fornecedorTemp;
        });
      }
    },
    actions: {
      async loadFornecedores() {
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