import { defineStore } from 'pinia'
import api from "../axios"
import { ref } from 'vue'

export const useUsuarioStore = defineStore("usuario", {
    persist: true,
    state: () => ({
        usuario: {},
        token: '',
    }),
    getters: {
      getUsuario(state){
          return state.usuario
        }
    },
    actions: {
        async login(data){
            try {
                const response = await api.post('/login', data);
                
                await localStorage.setItem("token", response.data.access_token);
                this.token = localStorage.getItem("token");

                return true;
            } catch (error) {
                localStorage.setItem("token", '');
                this.token = '';
                return false;
            }
        },

        async loadUsuario(){
            try {
                const response = await api.get('/user/show-user-log');
                
                this.usuario = response.data;

                return true;
            } catch (error) {

                return false;
            }
        },

        async verifyToken(){
            try {
                const response = await api.get('/verify-token');

                return true;
            } catch (error) {

                return false;
            }
        }
    },
  });