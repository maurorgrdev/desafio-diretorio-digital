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
        const fornecedorTemp = state.fornecedores.map((fornecedor) => {
          return {
            codigo: fornecedor.codigo,
            nome: fornecedor.empresa,
            email: fornecedor.email,
            cnpj: fornecedor.cnpj,
            atuacao: fornecedor.atuacao,
            cep: fornecedor.cep,
          }
        });
        console.log(fornecedorTemp);
        return fornecedorTemp;
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