<template>
    <v-container>
        <v-card 
            class="mx-auto"
            max-width="500">
            <v-card-item>
                <v-form validate-on="submit lazy" @submit.prevent="validate">
                    <v-row>
                        <v-text-field
                        v-model="login"
                        label="CPF ou Email"
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <v-text-field
                        v-model="password"
                        label="Password"
                        ></v-text-field>
                    </v-row>
                    <v-btn
                    type="submit"
                    block
                    class="mt-2"
                    text="Login"
                    ></v-btn>
                </v-form>
            </v-card-item>
        </v-card>
    </v-container>
</template>

<script>
    import { useUsuarioStore } from '../../store/user.js'
  export default {
    data: vm => ({
      timeout: null,
      login: '',
      password: '',
    }),

    setup() {
        const usuarioStore = useUsuarioStore()

        return { usuarioStore }
    },

    methods: {
      async validate(){

        const valido = this.validaCnpj(this.login) || this.validaEmail(this.login);

        if(valido){
            const results = {
                email: await this.validaEmail(this.login) ? this.login : '',
                cnpj: await this.validaCnpj(this.login) ? this.login : '',
                password: this.password
            }

            await this.submit(results);
        }  else {
            alert('Login inválido');
        }

        
      },

      async submit (results) {
        const response = await this.usuarioStore.login(results);
        
        await this.usuarioStore.loadUsuario();
        if(response){
            this.$router.push('/fornecedores');
        } 
      },
      async checkApi (userName) {
        return new Promise(resolve => {
          clearTimeout(this.timeout)

          this.timeout = setTimeout(() => {
            if (!userName) return resolve('Please enter a user name.')
            if (userName === 'johnleider') return resolve('User name already taken. Please try another one.')

            return resolve(true)
          }, 1000)
        })
      },

        validaCnpj(cnpj) {
            cnpj = cnpj.replace(/[^\d]+/g, '');

            if (cnpj.length != 14)
                return false;

            var tamanhoTotal = cnpj.length - 2
            var cnpjSemDigitos = cnpj.substring(0, tamanhoTotal);
            var digitosVerificadores = cnpj.substring(tamanhoTotal);
            var soma = 0;
            var pos = tamanhoTotal - 7;
            for (var i = tamanhoTotal; i >= 1; i--) {
                soma += cnpjSemDigitos.charAt(tamanhoTotal - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitosVerificadores.charAt(0))
                return false;

            var tamanhoTotal = tamanhoTotal + 1;
            var cnpjSemDigitos = cnpj.substring(0, tamanhoTotal);
            var soma = 0;
            var pos = tamanhoTotal - 7;
            for (i = tamanhoTotal; i >= 1; i--) {
                soma += cnpjSemDigitos.charAt(tamanhoTotal - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }

            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitosVerificadores.charAt(1))
                return false;

            return true;
        },

        validaEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    },
  }
</script>

<!-- <script setup>

import { reactive } from 'vue'
import { useUsuarioStore } from "../../store/user"

const store = useUsuarioStore()

let login = ''
let password = ''

const nameRules = [
    value => {
        if (value) return true

        return 'Name is required.'
    },
    value => {
        if (value?.length <= 10) return true

        return 'Name must be less than 10 characters.'
    },
]
let email = ''
const emailRules = [
    value => {
        if (value) return true

        return 'E-mail is requred.'
    },
    value => {
        if (/.+@.+\..+/.test(value)) return true

        return 'E-mail must be valid.'
    },
]


function userLogin() {
    const dados = reactive({
        login: login,
        password: password,
    })  
    
    store.login(dados);
}
</script> -->