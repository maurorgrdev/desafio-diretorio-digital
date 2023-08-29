import { defineStore } from 'pinia'
import api from "../axios"

export const useUsuarioStore = defineStore("usuario", {
    persist: true,
    state: () => ({
        usuario: {},
        token: {},
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
                
                await console.log(response);
                await localStorage.setItem("token", response.data.access_token);

                return true;
            } catch (error) {
                localStorage.setItem("token", '');

                return false;
            }
        },

        async loadUsuario(){
            try {
                const response = await api.get('/user/show-user-log');
                
                this.usuario = response.data;

                return true;
            } catch (error) {
                localStorage.setItem("token", '');

                return false;
            }
        }
    },
  });