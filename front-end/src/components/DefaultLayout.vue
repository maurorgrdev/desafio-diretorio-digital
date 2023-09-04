<template>
    <v-app id="inspire">
      <v-navigation-drawer v-model="drawer">
        <v-sheet
          color="grey-lighten-4"
          class="pa-4"
        >
          <v-avatar
            class="mb-4"
            color="grey-darken-1"
            size="64"
          ></v-avatar>
  
          <div>{{getUsuario.nome}}</div>
        </v-sheet>
  
        <v-divider></v-divider>
  
        <v-list>
          <v-list-item
            v-for="[icon, text] in links"
            :key="icon"
            :prepend-icon="icon"
            :title="text"
            link
          ></v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-main>
        <router-view></router-view>
      </v-main>
    </v-app>
  </template>
  
  
  <script setup>
    import { ref } from 'vue'
    import { useUsuarioStore } from '@/store/user';
    import {  computed } from 'vue';
    import { onMounted } from 'vue';
  
    const store = useUsuarioStore();

    const cards = ['Today', 'Yesterday']
    const links = [
      ['mdi-inbox-arrow-down', 'Fornecedores'],
    ]

    const getUsuario = computed(() => {
      return store.getUsuario;
    })

    onMounted(() => {
      // window.location.reload(true);
    })
  
    const drawer = false
  </script>
  
  <!-- <script>
    name: 'APP'
    export default {
      data: () => ({
        cards: ['Today', 'Yesterday'],
        drawer: null,
        links: [
          ['mdi-inbox-arrow-down', 'Inbox'],
          ['mdi-send', 'Send'],
          ['mdi-delete', 'Trash'],
          ['mdi-alert-octagon', 'Spam'],
        ],
      }),
    }
  </script> -->