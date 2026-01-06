<template>
  <div class="max-w-7xl mx-auto space-y-6">
    <div
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm"
    >
      <div
        class="border-b border-slate-200 dark:border-gray-700 px-6 py-4"
        style="background: linear-gradient(to right, #20986910, transparent)"
      >
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900 dark:text-gray-100">
              Analisador de Apostas
            </h2>
            <p class="text-sm text-slate-600 dark:text-gray-300 mt-0.5">
              Selecione seus números e veja a análise em tempo real
            </p>
          </div>
        </div>
      </div>

      <div class="px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Seletor de Números -->
          <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
              <div class="text-sm text-slate-600 dark:text-gray-300">
                <span
                  class="text-2xl font-bold text-slate-900 dark:text-gray-100"
                  >6</span
                >
                <span class="text-slate-400 mx-1">/</span>
                <span class="text-lg font-semibold">6</span>
                <span class="ml-2 text-slate-500 dark:text-gray-400"
                  >dezenas selecionadas</span
                >
              </div>
              <div class="flex gap-3">
                <button
                  class="inline-flex items-center gap-2 rounded border border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-slate-700 dark:text-gray-300 font-medium text-sm px-4 py-2.5 transition-all hover:bg-red-50 hover:border-red-300 hover:text-red-700"
                >
                  <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                  Limpar
                </button>
              </div>
            </div>

            <lotto-numbers-selector
              v-model:numbers="number.items"
              v-bind="{
                color: scope.lottoRaffleTypeSelect.response.entity.color,
                poolMin: scope.lottoRaffleTypeSelect.response.entity.pool_min,
                poolMax: scope.lottoRaffleTypeSelect.response.entity.pool_max,
                poolCols: scope.lottoRaffleTypeSelect.response.entity.pool_cols,
              }"
            />
          </div>

          <!-- Painéis de Alertas -->
          <div class="space-y-4">
            <h3
              class="text-sm font-semibold text-slate-700 dark:text-gray-300 mb-4"
            >
              Análise da Aposta
            </h3>

            <lotto-alert
              type="warning"
              title="Número Repetido"
              text="O número <strong>12</strong> saiu nos últimos 2 concursos consecutivos"
            />
            <lotto-alert
              type="error"
              title="Padrão Perigoso"
              text="Números muito próximos: <strong>34, 45</strong> podem reduzir chances"
            />
            <lotto-alert
              type="info"
              title="Sugestão"
              text="Considere incluir números acima de 40 para melhor distribuição"
            />
            <lotto-alert
              type="success"
              title="Boa Distribuição"
              text="Números bem distribuídos entre dezenas baixas e altas"
            />
          </div>
        </div>
      </div>
    </div>

    <lotto-numbers-analisys
      :numbers="number.items"
      :type-id="scope.lottoRaffleTypeSelect.response.entity.id"
    />
  </div>
</template>

<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});

const number = reactive({
  items: [],
});
</script>
