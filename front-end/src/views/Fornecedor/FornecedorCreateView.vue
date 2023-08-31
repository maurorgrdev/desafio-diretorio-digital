<template>
    <v-container style="max-width: 70%;">
        <FornecedorForm 
            :title="title" 
            :subtitle="subtitle"
            :dados-fornecedor="dadosFornecedor"
            v-on:onClickConfirm="confirmForm"
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

async function confirmForm(fornecedorCreate, arquivoFornecedor){
    await store.addFornecedor(fornecedorCreate);

    await uploadArquivoFornecedor(arquivoFornecedor);

    router.push({ path: '/fornecedores' });
}

async function uploadArquivoFornecedor(arquivoFornecedor){
    
    let form = new FormData()
    form.append('file', arquivoFornecedor)
    form.append('name', arquivoFornecedor.name)
    console.log(form);
    console.log('after');

    const haha = await api.post("/upload-fornecedor", form, {
      baseURL: 'http://localhost:8000/api/',
      headers: {
        "Content-Type": "multipart/form-data"
      }
    });
  }
</script>