<template>
    <v-container style="max-width: 70%;">
        <FornecedorForm 
            :title="title" 
            :subtitle="subtitle"
            :dados-fornecedor="novoFornecedor"
            tipo="edicao"
            v-on:on-click-confirm="callBackConfirmForm"
            v-on:on-click-download-file="callBackDownload"
            v-on:on-click-delete-file="callBackDeleteFile"
        ></FornecedorForm>
    </v-container>
</template>

<script setup>
    import { useFornecedorStore } from '@/store/fornecedores';
    import FornecedorForm from '@/components/Fornecedor/FornecedorForm.vue';
    import { onMounted, computed, toRefs } from 'vue';
    import api from '@/axios';
    import { useRouter } from 'vue-router';
    import { defineProps } from 'vue'

    const router = useRouter()


    const props = defineProps(['id'])

    const store = useFornecedorStore()

    const title = 'Edição de Fornecedor'
    const subtitle = 'Editando um fornecedor'

    const { id } = toRefs(props);

    onMounted(async () => {
        await store.loadFornecedor(id.value);
    })

    const novoFornecedor = computed(() => {
        return store.getFornecedor
    })

    const emit = defineEmits(['change', 'delete'])    

    async function callBackConfirmForm(fornecedorAtualizado, arquivoFornecedor, arquivoFlag){
        const responseEditFornecedor = await store.editFornecedor(fornecedorAtualizado);

        if( responseEditFornecedor.success ) {    
            if(arquivoFlag){
                const responseFile = await uploadArquivoFornecedor(arquivoFornecedor, fornecedorAtualizado);

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

    async function callBackDeleteFile(fornecedor_id){
        await api.delete(`/delete-fornecedor/${fornecedor_id}`, {
            baseURL: 'http://localhost:8000/api/',
            responseType: 'json',
        });

        await store.loadFornecedor(id.value);
    }
</script>