<template>
  <div class="hello">
    <h1>{{ fornecedores }}</h1>
    <h1>Made By Getters</h1>
    <div v-for="user in getFornecedores" :key="user.id">
      {{ user.id }} {{ user.name }} {{ user.address }}
    </div>
    <h1>Made By Actions</h1>
    <div v-for="user in fornecedores" :key="user.id">
      {{ user.id }} {{ user.name }} {{ user.address }}
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useFornecedorStore } from "../store/fornecedores";
  
  const store = useFornecedorStore();
  
  const msg = ref("Welcome to my Vuex Store");
  
  const getFornecedores = computed(() => {
    return store.getFornecedores;
  });

  const fornecedores = computed(() => {
    return store.fornecedores;
  });
  
  onMounted(() => {
    store.fetchFornecedores();
  });
</script>