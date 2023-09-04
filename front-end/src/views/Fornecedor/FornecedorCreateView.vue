<template>
    <v-container style="max-width: 70%;">
        <FornecedorForm 
            :title="title" 
            :subtitle="subtitle"
            :dados-fornecedor="dadosFornecedor"
            tipo="criacao"
            v-on:on-click-confirm="callBackConfirmForm"
        ></FornecedorForm>
    </v-container>
</template>

<script setup>
import FornecedorForm from '@/components/Fornecedor/FornecedorForm.vue';
import { useFornecedorStore } from '@/store/fornecedores';
import { reactive } from 'vue'
import api from 'axios'
import { ref, onMounted, computed } from "vue";
import { useRouter } from 'vue-router';

const router = useRouter()

const store = useFornecedorStore();

const title = 'Cadastro de Fornecedor'
const subtitle = 'Cadastrando um novo fornecedor'

let dadosFornecedor = {}

async function callBackConfirmForm(fornecedorCreate, arquivoFornecedor, arquivoFlag){
  const responseAddFornecedor = await store.addFornecedor(fornecedorCreate)

  if( responseAddFornecedor.success ) {    
    if(arquivoFlag){
      const responseFile = await uploadArquivoFornecedor(arquivoFornecedor, fornecedorCreate)

      if(!responseFile.success){
        alert('Erro ao cadastrar arquivo')
      }
    }

    router.push({  path: '/fornecedores' })
  } else {
    alert('Erro ao cadastrar fornecedor ')
  }
}

async function uploadArquivoFornecedor(arquivoFornecedor, fornecedorCreate){
  let form = new FormData()
  form.append('file', arquivoFornecedor)
  form.append('name', arquivoFornecedor.name)
  form.append('fornecedor_email', fornecedorCreate.email)

  try {
    const responseUpload = await api.post("/upload-fornecedor", form, {
      baseURL: 'http://localhost:8000/api/',
      headers: {
        "Content-Type": "multipart/form-data"
      }
    });

    return responseUpload.data;
  } catch (error) {
    return error;
  }
}
</script>