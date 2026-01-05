<template>
  <div class="mx-auto space-y-6">
    <lotto-card
      title="Último Sorteio"
      subtitle="Concurso 2650"
    >
      <template #default>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Seletor de Números -->
          <div class="lg:col-span-2">
            <lotto-numbers-selector
              :color="scope.lottoRaffleTypeSelect.response.entity.color"
            />
          </div>

          <!-- Painéis de Alertas -->
          <div class="space-y-4">
            <h3
              class="text-sm font-semibold text-slate-700 dark:text-gray-300 mb-4"
            >
              Análise dos Números
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
      </template>

      <template #footer>
        <div class="grid grid-cols-2 gap-4 w-full">
          <div>
            <p class="text-xs text-slate-500 dark:text-gray-400 mb-1">
              Prêmio estimado próximo concurso
            </p>
            <p
              class="text-lg font-semibold"
              style="color: #209869"
            >
              R$ 35.000.000
            </p>
          </div>
          <div class="text-right">
            <p class="text-xs text-slate-500 dark:text-gray-400 mb-1">
              Próximo sorteio
            </p>
            <p class="text-lg font-semibold text-slate-900 dark:text-gray-100">
              Sábado, 20:00
            </p>
          </div>
        </div>
      </template>
    </lotto-card>

    <div
      v-if="scope.lottoRaffleTypeSelect.response.entity.last_draw"
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm"
    >
      <div class="px-6 py-4 border-b border-slate-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-gray-100">
          Análise dos Números
        </h3>
        <p class="text-sm text-slate-500 dark:text-gray-400 mt-0.5">
          Estatísticas detalhadas de cada número sorteado
        </p>
      </div>

      <div class="divide-y divide-slate-200 dark:divide-gray-700">
        <template
          v-for="nn in scope.lottoRaffleTypeSelect.response.entity.last_draw
            .result"
        >
          <nuxt-link
            :to="`/loteria/${scope.route.params.slug}/numero/${nn}`"
            class="px-6 py-3 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700 transition"
          >
            <div
              class="w-12 h-12 rounded flex items-center justify-center text-lg font-bold text-white shadow-sm flex-shrink-0"
              :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
            >
              {{ nn.toString().padStart(2, "0") }}
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-slate-900 dark:text-gray-100">
                Sorteado 23 vezes nos últimos 100 concursos
              </p>
              <p class="text-xs text-slate-500 dark:text-gray-400 mt-0.5">
                Último sorteio há 3 concursos • Frequência: 23%
              </p>
            </div>
          </nuxt-link>
        </template>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});

const isDark = useState("darkMode", () => false);
</script>
