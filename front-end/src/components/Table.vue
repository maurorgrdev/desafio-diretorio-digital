<template>
    <v-table class="table-style" :v-show="showTable">
            <thead>
                <tr>
                    <th  v-for="item in headers"  class="text-center">{{item}}</th>
                    <th class="text-center"> Ações </th>
                </tr>
            </thead>
        <tbody>
            <tr
                v-for="itens in dadosInArray"
                
            >
                <td v-for="item in itens" >{{ item }}</td>
                <td>
                    <v-row>
                        <v-col cols="3"> <v-btn v-on:click="$emit('onClickEdit', itens[0])" class="btn-action" density="compact" icon="mdi-pencil"></v-btn> </v-col>
                        <v-col v-show="itens[itens.length - 1] != ''" cols="3"> <v-btn v-on:click="$emit('onClickDelete', itens[0])"  class="btn-action" density="compact" icon="mdi-delete"></v-btn> </v-col>
                        <v-col cols="3"> <v-btn v-on:click="$emit('onClickShow', itens[0])" class="btn-action" density="compact" icon="mdi-eye"></v-btn> </v-col>
                        <v-col v-show="itens[itens.length - 1] != ''" cols="3"> <v-btn v-on:click="$emit('onClickDownload', itens[0] , itens[(itens.length - 1)])" class="btn-action" density="compact" icon="mdi-download"></v-btn> </v-col>
                    </v-row>
                </td>
            </tr>
        </tbody>
    </v-table>
</template>
<script>
export default {
    props: ['headers', 'dados', 'showTable'],

    emits: ['onClickEdit', 'onClickShow', 'onClickDelete', 'onClickDownload'],

    data: () => ({
        dadosInArray: [],
    }),

    setup() {

    },

    beforeUpdate () {
        this.dadosInArray = this.dados.map(function(obj) {
            return Object.keys(obj).map(function(key) {
                return obj[key];
            });
        });
    },

    async mounted() {
        
    },

    methods: {
    },
}
</script>

<style>
.table-style{
    border-collapse: collapse;
    border: 1px solid;
}
th, td {
    padding: 15px;
    text-align: center;
}

.btn-action{
    text-align: center;    /* essa declaração sozinha fez a centralização */
    padding-left: 6px; /* essa declaração é dispensável para realizar a centralização??  */
}
</style>