<template>
    <v-container>
        <Table :headers="headersTable" :dados="store.getFornecedores"></Table>
    </v-container>
</template>

<script setup>
    import { watch, onMounted, ref, computed} from 'vue'
    import { useFornecedorStore } from '../../store/fornecedores.js'
    import Table from '@/components/Table.vue';

    const store = useFornecedorStore();

    const getFornecedores = computed(() => {
        return store.getFornecedores;
    })

    const dados = [];

    onMounted(() => {
        store.fetchFornecedores();
    })

    const headersTable = [
        'CNPJ',
        'Email',
        'Nome'
    ]
</script>