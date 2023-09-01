<template>
    <v-container>
        <v-row class="container-main">
            <v-col cols="10">
                <div class="text-h5"> Cadastro de Fornecedor</div>
            </v-col>

            <v-spacer></v-spacer>

            <v-col cols="2">
                <div >
                    <v-btn
                        class="btn-form"
                        color="blue-darken-4"
                        @click="router.push({ path: '/fornecedores/novo'})"
                    >
                        NOVO
                    </v-btn>
                </div>
            </v-col>
        </v-row>
        
        <Table
            v-on:on-click-edit="callBackEdit" 
            v-on:on-click-show="callBackShow"
            v-on:on-click-delete="callBackDelete"
            v-on:on-click-download="callBackDownload"
            :showTable="showTable" 
            :headers="headersTable" 
            :dados="store.getFornecedoresToTable"
        ></Table>
    </v-container>
</template>

<script setup>
    import { watch, onMounted, ref, computed} from 'vue'
    import { useFornecedorStore } from '@/store/fornecedores.js'
    import { useRouter } from 'vue-router'; 

    import Table from '@/components/Table.vue';
    import Title from '@/components/Title.vue';
    import api from '@/axios';

    import DialogTeste from '@/components/Dialog.vue';

    const router = useRouter()

    const store = useFornecedorStore();

    let showTable = false

    const getFornecedores = computed(() => {
        return store.getFornecedores;
    })

    const getFornecedoresToTable = computed(() => {
        return store.getFornecedoresToTable;
    })

    const dados = [];

    onMounted(async () => {
        await store.loadFornecedores();

        showTable = true
    })

    const headersTable = [
        'Codigo',
        'Nome',
        'Email',
        'CNPJ',
        'Atuação',
        'Arquivo',
    ]

    let showDialog = true

    function callBackEdit(fornecedor_id){
        router.push({ path: `/fornecedores/edita/${fornecedor_id}`});
    }

    async function callBackDelete(fornecedor_id){
        await api.delete(`/delete-fornecedor/${fornecedor_id}`, {
            baseURL: 'http://localhost:8000/api/',
            responseType: 'json',
        });

        await store.loadFornecedores();
    }

    function callBackShow(fornecedor_id){
        router.push({ path: `/fornecedores/visualiza/${fornecedor_id}`});
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

<style>
.container-main{
    padding-top: 10px;
    padding-bottom: 30px;
}
.btn-form{
    width: 150px;
}
</style>