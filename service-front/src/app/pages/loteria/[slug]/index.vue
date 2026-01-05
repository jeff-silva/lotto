<template>
  <div class="mx-auto space-y-6">
    <div
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm"
    >
      <div
        class="border-b border-slate-200 dark:border-gray-700 px-6 py-4"
        :style="
          isDark
            ? 'background: linear-gradient(to right, #20986920, transparent)'
            : 'background: linear-gradient(to right, #20986910, transparent)'
        "
      >
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900 dark:text-gray-100">
              Último Sorteio
            </h2>
            <p class="text-sm text-slate-600 dark:text-gray-300 mt-0.5">
              Concurso 2650
            </p>
          </div>
          <div class="text-right">
            <p class="text-xs text-slate-500 dark:text-gray-400">
              Data do sorteio
            </p>
            <p
              class="text-sm font-medium text-slate-700 dark:text-gray-300 mt-0.5"
            >
              28/12/2024
            </p>
          </div>
        </div>
      </div>

      <div
        v-if="scope.lottoRaffleTypeSelect.response.entity.last_draw"
        class="px-6 py-8"
      >
        <div class="flex justify-center">
          <div class="flex flex-wrap gap-2 justify-center">
            <template
              v-for="nn in scope.lottoRaffleTypeSelect.response.entity.last_draw
                .result"
            >
              <div
                class="w-14 h-14 rounded flex items-center justify-center text-xl font-bold text-white shadow-md"
                :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
              >
                {{ nn.toString().padStart(2, "0") }}
              </div>
            </template>
          </div>
        </div>
      </div>

      <div
        class="border-t border-slate-200 dark:border-gray-700 px-6 py-4 bg-slate-50 dark:bg-gray-700"
      >
        <div class="grid grid-cols-2 gap-4">
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
      </div>
    </div>

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
