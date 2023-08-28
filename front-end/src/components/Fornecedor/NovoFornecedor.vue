<template>
    <v-form ref="form">
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.nome_empresa"
            :rules="nameRules"
            :counter="10"
            label="Nome Empresa"
            required
            hide-details
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.email"
            :rules="emailRules"
            label="E-mail"
            hide-details
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.cnpj"
            :rules="nameRules"
            :counter="14"
            label="CNPJ"
            hide-details
            required
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
            :rules="nameRules"
            label="CEP"
            required
            hide-details
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.endereco"
            :rules="nameRules"
            label="Endereço"
            hide-details
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.numero"
            :rules="nameRules"
            label="Número"
            hide-details
            required
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
            :rules="nameRules"
            label="Complemento"
            required
            hide-details
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.bairro"
            :rules="nameRules"
            label="Bairro"
            hide-details
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.cidade"
            :rules="nameRules"
            label="Cidade"
            hide-details
            required
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
            :rules="nameRules"
            label="Estado"
            required
            hide-details
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.telefone"
            :rules="nameRules"
            label="Telefone"
            hide-details
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="dados.atuacao"
            :rules="nameRules"
            label="atuacao"
            hide-details
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-file-input
          @change="novoArquivo"
          chips
          multiple
          label="File input w/ chips"
        ></v-file-input>
      </v-row>
      <div class="d-flex flex-column">
        <v-btn
          color="success"
          class="mt-4"
          block
          @click="validate"
        >
          Validate
        </v-btn>

        <v-btn
          color="error"
          class="mt-4"
          block
          @click="reset"
        >
          Reset Form
        </v-btn>

        <v-btn
          color="warning"
          class="mt-4"
          block
          @click="resetValidation"
        >
          Reset Validation
        </v-btn>
      </div>
    </v-container>
  </v-form>
</template>

<script setup>
  import { reactive } from 'vue'
  import api from 'axios'
  import { ref, onMounted, computed } from "vue";
  import { useFornecedorStore } from "../../store/fornecedores";

  const store = useFornecedorStore();

  const getFornecedores = computed(() => {
    return store.getFornecedores;
  });

  const fornecedores = computed(() => {
    return store.fornecedores;
  });

  onMounted(() => {
    console.log('teste');
  });

  const valid = true
  
  const dadosIniciais = {
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

  let arquivoSelecionado
   
  const dados = reactive({
    ...dadosIniciais,
  })

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

  function clear () {
    v$.value.$reset()

    for (const [key, value] of Object.entries(initialState)) {
      state[key] = value
    }
  }

  function submit(){
    // store.addFornecedor(dados); 
    console.log('passou');
  }

  function  validate () {
    submit();
    upload();
  }
  
  function reset () {
    this.$refs.form.reset()
  }
  
  function resetValidation () {
    this.$refs.form.resetValidation()
  }

  function novoArquivo(event){
    // console.log(event);
    arquivoSelecionado = event.target.files[0]
  }

  async function upload(){
    
    let form = new FormData()
    form.append('file', arquivoSelecionado)
    form.append('name', arquivoSelecionado.name)
    console.log(form);
    console.log('after');

    const haha = await api.post("/upload-fornecedor", form, {
      baseURL: 'http://localhost:8000/api/',
      headers: {
        "Content-Type": "multipart/form-data"
      }
    });
    console.log(haha);
  }
</script>