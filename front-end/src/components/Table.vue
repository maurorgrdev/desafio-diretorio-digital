<template>
    <v-table>
        <thead>
        <tr>
            <th  v-for="item in headers" v-once class="text-left">item</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="itens in dadosInArray"
            :key="itens[0]"
        >
            <td v-for="item in itens" v-once>{{ item }}</td>
        </tr>
        </tbody>
    </v-table>
</template>
<script>
export default {
    props: ['headers', 'dados'],

    data: () => ({
        dadosInArray: [],
    }),

    async mounted() {
        this.dadosInArray = await this.dados.map(function(obj) {
            return Object.keys(obj).map(function(chave) {
                return obj[chave];
            });
        });
    },

    methods: {

    },
}
</script>