<template>
    <v-container class="container-main">
        <v-table class="table-style" :v-show="showTable">
                <thead>
                    <tr>
                        <th  v-for="item in headers"  class="text-center">{{item}}</th>
                        <th class="text-center"> Ações </th>
                    </tr>
                </thead>
            <tbody>
                <tr
                    v-for="itens in objectToArray()"
                    :key="itens[0]"
                >
                    <td v-for="item in itens" v-once>{{ item }}</td>
                    <td>
                        <v-row>
                            <v-col cols="3"> <v-btn v-on:click="$emit('onClickEdit', $event)" class="btn-action" density="compact" icon="mdi-pencil"></v-btn> </v-col>
                            <v-col cols="3"> <v-btn v-on:click="$emit('onClickDelete', $event)"  class="btn-action" density="compact" icon="mdi-delete"></v-btn> </v-col>
                            <v-col cols="3"> <v-btn v-on:click="$emit('onClickShow', $event)" class="btn-action" density="compact" icon="mdi-eye"></v-btn> </v-col>
                            <v-col cols="3"> <v-btn v-on:click="$emit('onClickDownload', $event)" class="btn-action" density="compact" icon="mdi-download"></v-btn> </v-col>
                        </v-row>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-container>
</template>
<script>
export default {
    props: ['headers', 'dados', 'showTable'],

    emits: ['onClickEdit'],

    data: () => ({
        dadosInArray: [],
    }),

    async mounted() {
        
        
    },

    methods: {
        objectToArray(){
            return this.dados.map(function(obj) {
                return Object.keys(obj).map(function(chave) {
                    return obj[chave];
                });
            }); 
        }
    },
}
</script>

<style>
.container-main{
    max-width: 95%
}
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