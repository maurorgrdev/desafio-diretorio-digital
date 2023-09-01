import { defineStore } from 'pinia'
import api from "../axios"

export const useFornecedorStore = defineStore("fornecedor", {
    state: () => ({
        fornecedores: [],
        fornecedor: {},
    }),
    getters: {
      getFornecedor(state){
        return state.fornecedor
      },
      
      getFornecedores(state){
        return state.fornecedores
      },

      getFornecedoresToTable(state){
        const fornecedorTemp = state.fornecedores.map((fornecedor) => {
          return {
            codigo: fornecedor.codigo,
            empresa: fornecedor.empresa,
            email: fornecedor.email,
            cnpj: fornecedor.cnpj,
            atuacao: fornecedor.atuacao,
            arquivo_filename: fornecedor.arquivo_filename,
          }
        });
        
        return fornecedorTemp;
      }
    },
    actions: {
      async loadFornecedor(codigo){
        try {
          const data = await api.get(`/fornecedores/${codigo}`)
          // console.log(data.data);
          this.fornecedor = {...data.data}
        }
          catch (error) {
            alert(error)
            
        }
      },

      async loadFornecedores() {
        try {
          const data = await api.get('/fornecedores')
          this.fornecedores = data.data
        }
          catch (error) {
            alert(error)
            
        }
      },

      async addFornecedor(data){
        try {
          const response = await api.post('/fornecedores', data);

          return response.data;

        } catch (error) {
          return error;
        }
      },

      async editFornecedor(data){
        try {
          const response = await api.patch(`/fornecedores/${data.codigo}`, data);

          return response.data;
        } catch (error) {
          return error;
        }
      }
    },
  });