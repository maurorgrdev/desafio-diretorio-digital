<template>
    <v-table theme="dark">
        <thead>
            <tr>
                <th class="text-left">
                Nome
                </th>
                <th class="text-left">
                Cnpj
                </th>
                <th class="text-left">
                Email
                </th>
                <th class="text-left">
                Ações
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="item in getFornecedores"
                :key="item.empresa"
            >
                <td>{{ item.empresa }}</td>
                <td>{{ item.cnpj }}</td>
                <td>{{ item.email }}</td>
                <td> <v-btn density="compact" icon="pencil" color="white"></v-btn> </td>
            </tr>
        </tbody>
    </v-table>

</template>

<script setup>
    import { watch, onMounted, ref, computed} from 'vue'
    import { useFornecedorStore } from '../../store/fornecedores.js'

    const store = useFornecedorStore();

    const getFornecedores = computed(() => {
        return store.getFornecedores;
    })

    const dados = [];

    onMounted(() => {
        store.fetchFornecedores();
    })
</script>