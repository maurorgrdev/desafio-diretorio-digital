import { defineStore } from 'pinia'
import api from "../axios"
import { ref } from 'vue'

export const useUsuarioStore = defineStore("usuario", {
    persist: true,
    state: () => ({
        usuario: {},
        token_user: '',
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
                
                const token_acess = response.data.access_token;
                
                await localStorage.setItem("token", token_acess);
                this.token_user = token_acess;

                return true;
            } catch (error) {
                localStorage.setItem("token", '');
                this.token_user = '';
                this.usuario = {};
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
                const response = await api.get('/verify-token', {
                    baseURL: 'http://localhost:8000/api/',
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("token")}`,
                        Accept: "application/json",
                        "Content-Type": "application/json;charset=UTF-8",
                    }
                  });

                return true;
            } catch (error) {

                return false;
            }
        }
    },
  });