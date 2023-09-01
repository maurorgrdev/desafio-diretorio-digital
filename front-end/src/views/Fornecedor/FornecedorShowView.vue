<template>
    <v-container style="max-width: 70%;">
        <FornecedorForm 
            :title="title" 
            :subtitle="subtitle"
            :dados-fornecedor="novoFornecedor"
            tipo="show"
            v-on:on-click-download-file="callBackDownload"
        ></FornecedorForm>
    </v-container>
</template>

<script setup>
    import { useFornecedorStore } from '@/store/fornecedores';
    import FornecedorForm from '@/components/Fornecedor/FornecedorForm.vue';
    import { onMounted, computed, toRefs } from 'vue';
    import { defineProps } from 'vue'

    import api from '@/axios';
    import { useRouter } from 'vue-router';

    const router = useRouter()

    const store = useFornecedorStore()

    const props = defineProps(['id'])

    const title = 'Visulização de Fornecedor'
    const subtitle = 'Visulizando um fornecedor'

    const { id } = toRefs(props);

    onMounted(async () => {
        await store.loadFornecedor(id.value);
    })

    const novoFornecedor = computed(() => {
        return store.getFornecedor
    })  

    async function callBackConfirmForm(fornecedorAtualizado, arquivoFornecedor){
        router.push({ path: '/fornecedores' });
    }

    async function callBackDownload(fornecedor_id, file_name){
        await api.get(`/download-fornecedor/${fornecedor_id}`, {
            baseURL: 'http://localhost:8000/api/',
            responseType: 'blob',
        }).then((response) => {
            const fileUrl = window.URL.createObjectURL(new Blob([response.data]))
            
            let fileLink = document.createElement('a')
            fileLink.href = fileUrl
            fileLink.setAttribute('download', file_name)
            document.body.appendChild(fileLink)
            fileLink.click();
        });
    }
</script>