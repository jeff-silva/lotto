<template>
  <div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-3 flex-1">
        <div
          class="w-16 h-16 rounded flex items-center justify-center text-2xl font-bold text-white shadow-md"
          :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
        >
          {{ scope.route.params.number }}
        </div>
        <div>
          <h1 class="text-3xl font-semibold text-slate-900 dark:text-gray-100">
            Análise do Número {{ scope.route.params.number }}
          </h1>
          <p class="text-sm text-slate-500 dark:text-gray-400 mt-1">
            {{ scope.lottoRaffleTypeSelect.response.entity.name }} •
            Estatísticas completas e tendências
          </p>
        </div>
      </div>
    </div>

    <lotto-numbers-analisys />
  </div>
</template>

<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});
</script>
