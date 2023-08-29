<template>
    <v-container>
        <Title title="Fornecedores"></Title>
        <Table  
            v-on:onClickEdit="callBackEdit" 
            v-on:onClickShow="callBackShow"
            v-on:onClickDelete="callBackDelete"
            v-on:onClickDownload="callBackDownload"
            :showTable="showTable" 
            :headers="headersTable" 
            :dados="store.getFornecedoresToTable"
        ></Table>
    </v-container>
</template>

<script setup>
    import { watch, onMounted, ref, computed} from 'vue'
    import { useFornecedorStore } from '@/store/fornecedores.js'
    import Table from '@/components/Table.vue';
    import Title from '@/components/Title.vue';

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
        'CNPJ',
        'Email',
        'Atuação',
    ]

    function callBackEdit(event){
        console.log('ola gleiciane');
    }

    function callBackDelete(event){
        console.log('ola gleiciane');
    }

    function callBackShow(event){
        console.log('ola gleiciane');
    }

    function callBackDownload(event){
        console.log('ola gleiciane');
    }
</script>