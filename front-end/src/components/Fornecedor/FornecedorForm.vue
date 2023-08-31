<template>
  <v-card>
    <v-card  style="margin: 0 auto">
      <template v-slot:title>
        {{ title }}
      </template>

      <template v-slot:subtitle>
        {{ subtitle }}
      </template>

      <template v-slot:text>
        <v-row>
          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.nome_empresa"
              label="Nome"
              variant="solo"
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.email"
              label="E-mail"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.cnpj"
              :counter="14"
              label="CNPJ"
              variant="solo"
              
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.cep"
              label="CEP"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.endereco"
              label="Endereço"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.numero"
              label="Número"
              variant="solo"
              
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.complemento"
              label="Complemento"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.bairro"
              label="Bairro"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.cidade"
              label="Cidade"
              variant="solo"
              
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.estado"
              label="Estado"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.telefone"
              label="Telefone"
              variant="solo"
              
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            md="4"
          >
            <v-text-field
              v-model="dados.atuacao"
              label="atuacao"
              variant="solo"
              
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-spacer></v-spacer>
          <v-col cols="4" >
            <v-file-input
              @change="novoArquivo"
              chips
              multiple
              variant="outlined"
              label="File input w/ chips"
            ></v-file-input>
          </v-col>
        </v-row>

        
        <v-row >
          <div class="div-btn-left">
            <v-btn
              class="btn-form"
              color="error"
              @click="cancelarCadastro"
            >
              Cancelar
            </v-btn>
          </div>
          
          <v-spacer></v-spacer>
          
          <div class="div-btn-right">
            <v-btn
              class="btn-form"
              color="warning"
              @click="resetarFormulario"
            >
              Resetar
            </v-btn>
          </div>
          <div class="div-btn-right">
            <v-btn
              class="btn-form"
              color="success"
              @click="submit"
            >
              Salvar
            </v-btn>
          </div >
          <!-- </div> -->
        </v-row>
      </template>
    </v-card>
  </v-card>
</template>

<script>

export default {
  
  props: ['title', 'subtitle', 'dadosFornecedor'],

  emits: ['onClickConfirm'],

  data() {
    return { 
      dados: {
        nome_empresa: '',
        cnpj: '',
        email: '',
        cep: '',
        endereco: '',
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        estado: '',
        telefone: '',
        atuacao: '',
      },

      arquivoSelecionado: {},
    }
  },



  methods: {
    async submit () {
      if(await this.validateForm()){
        this.$emit('onClickConfirm', this.dados, this.arquivoSelecionado);
      } else {
        alert('poxa');
      }
    },

    validateForm () {
      return true;
    },

    novoArquivo(event){
      this.arquivoSelecionado = event.target.files[0]
    },

    resetarFormulario () {
      this.dados = {
        nome_empresa: '',
        cnpj: '',
        email: '',
        cep: '',
        endereco: '',
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        estado: '',
        telefone: '',
        atuacao: '',
      }
    },

    cancelarCadastro () {
      this.$router.push({ path: '/fornecedores' });
    },
  }
}
</script>

<!-- <script setup>
  const nameRules = [
    value => {
        if (value) return true

        return 'Nome é obrigatório.'
    },
    value => {
        if (value?.length <= 10) return true

        return 'Nome não pode ter mais de 10 letras.'
    },
  ]

  const emailRules = [
    value => {
        if (value) return true

        return 'E-mail é obrigatório.'
    },
    value => {
        if (/.+@.+\..+/.test(value)) return true

        return 'E-mail inválido.'
    },
  ]
  
</script>
-->

<style>
.div-btn-left {
  padding-left: 10px;
}

.div-btn-right {
  padding-right: 10px;
}

.btn-form{
  width: 150px;
}
</style> 