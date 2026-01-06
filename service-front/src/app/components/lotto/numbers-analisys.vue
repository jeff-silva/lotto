<script setup>
const props = defineProps({
  color: { type: String, default: "#000000" },
  typeId: { type: [Number, String], default: null },
  numbers: { type: Array, default: [2, 4, 6, 8, 10] },
});

const lottoRaffleTypeAnalisys = useAxios({
  method: "post",
  url: "/api/lotto_raffle_type/{id}/analisys",
  async run() {
    if (!props.typeId) return;
    lottoRaffleTypeAnalisys.url = `/api/lotto_raffle_type/${props.typeId}/analisys`;
    lottoRaffleTypeAnalisys.data.numbers = props.numbers;
    return await lottoRaffleTypeAnalisys.submit();
  },
});

lottoRaffleTypeAnalisys.run();

watch(
  () => [props.typeId, props.numbers],
  () => {
    lottoRaffleTypeAnalisys.run();
  }
);
</script>

<template>
  <div
    class="mx-auto space-y-6"
    v-if="lottoRaffleTypeAnalisys.response"
  >
    <!-- Seção de Análises Estatísticas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <lotto-card
        title="Sortudos"
        :subtitle="lottoRaffleTypeAnalisys.response.all_time_hot.name"
      >
        <div
          class="border border-orange-200 dark:border-orange-800 rounded-lg shadow-sm overflow-hidden"
        >
          <div class="flex flex-col">
            <template
              v-for="([num, times], index) in Object.entries(
                lottoRaffleTypeAnalisys.response.all_time_hot.result
              ).sort(([, a], [, b]) => b - a)"
            >
              <div
                class="flex items-center p-3 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-colors"
                :class="
                  index % 2 === 0
                    ? 'bg-white dark:bg-gray-800'
                    : 'bg-slate-50 dark:bg-gray-700'
                "
              >
                <div
                  class="text-xs font-bold text-orange-600 dark:text-orange-400 mr-3 w-4"
                >
                  {{ index + 1 }}
                </div>
                <div class="text-lg mr-3">🔥</div>
                <div class="flex items-center flex-1">
                  <span
                    class="w-8 h-8 bg-gradient-to-r from-orange-400 to-red-500 text-white text-xs font-bold rounded flex items-center justify-center shadow-sm mr-3"
                  >
                    {{ String(num).padStart(2, "0") }}
                  </span>
                  <span
                    class="text-sm font-medium text-slate-700 dark:text-gray-200"
                  >
                    {{ times }}x
                  </span>
                </div>
              </div>
            </template>
          </div>
        </div>
      </lotto-card>

      <lotto-card
        title="Azarados"
        :subtitle="lottoRaffleTypeAnalisys.response.all_time_bad.name"
      >
        <div
          class="border border-blue-200 dark:border-blue-800 rounded-lg shadow-sm overflow-hidden"
        >
          <div class="flex flex-col">
            <template
              v-for="([num, times], index) in Object.entries(
                lottoRaffleTypeAnalisys.response.all_time_bad.result
              ).sort(([, a], [, b]) => b - a)"
            >
              <div
                class="flex items-center p-3 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors"
                :class="
                  index % 2 === 0
                    ? 'bg-white dark:bg-gray-800'
                    : 'bg-slate-50 dark:bg-gray-700'
                "
              >
                <div
                  class="text-xs font-bold text-blue-600 dark:text-blue-400 mr-3 w-4"
                >
                  {{ index + 1 }}
                </div>
                <div class="text-lg mr-3">❄️</div>
                <div class="flex items-center flex-1">
                  <span
                    class="w-8 h-8 bg-gradient-to-r from-blue-400 to-slate-500 text-white text-xs font-bold rounded flex items-center justify-center shadow-sm mr-3"
                  >
                    {{ String(num).padStart(2, "0") }}
                  </span>
                  <span
                    class="text-sm font-medium text-slate-700 dark:text-gray-200"
                  >
                    {{ times }}x
                  </span>
                </div>
              </div>
            </template>
          </div>
        </div>
      </lotto-card>

      <lotto-card
        title="Sorteados"
        :subtitle="lottoRaffleTypeAnalisys.response.times_drawn.name"
      >
        <div
          class="border border-green-200 dark:border-green-800 rounded-lg shadow-sm overflow-hidden"
        >
          <div class="flex flex-col">
            <template
              v-for="([num, times], index) in Object.entries(
                lottoRaffleTypeAnalisys.response.times_drawn.result
              ).sort(([, a], [, b]) => b - a)"
            >
              <div
                class="flex items-center p-3 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-colors"
                :class="
                  index % 2 === 0
                    ? 'bg-white dark:bg-gray-800'
                    : 'bg-slate-50 dark:bg-gray-700'
                "
              >
                <div
                  class="text-xs font-bold text-green-600 dark:text-green-400 mr-3 w-4"
                >
                  {{ index + 1 }}
                </div>
                <div class="text-lg mr-3">🎯</div>
                <div class="flex items-center flex-1">
                  <span
                    class="w-8 h-8 bg-gradient-to-r from-green-400 to-emerald-500 text-white text-xs font-bold rounded flex items-center justify-center shadow-sm mr-3"
                  >
                    {{ String(num).padStart(2, "0") }}
                  </span>
                  <span
                    class="text-sm font-medium text-slate-700 dark:text-gray-200"
                  >
                    {{ times }}x
                  </span>
                </div>
              </div>
            </template>
          </div>
        </div>
      </lotto-card>

      <lotto-card
        title="Média de Intervalos"
        :subtitle="lottoRaffleTypeAnalisys.response.number_avg.name"
      >
        <div
          class="border border-purple-200 dark:border-purple-800 rounded-lg shadow-sm overflow-hidden"
        >
          <div class="flex flex-col">
            <template
              v-for="([num, avg], index) in Object.entries(
                lottoRaffleTypeAnalisys.response.number_avg?.result || {}
              ).sort(([, a], [, b]) => (a || Infinity) - (b || Infinity))"
            >
              <div
                class="flex items-center p-3 hover:bg-purple-50/50 dark:hover:bg-purple-900/10 transition-colors"
                :class="
                  index % 2 === 0
                    ? 'bg-white dark:bg-gray-800'
                    : 'bg-slate-50 dark:bg-gray-700'
                "
              >
                <div
                  class="text-xs font-bold text-purple-600 dark:text-purple-400 mr-3 w-4"
                >
                  {{ index + 1 }}
                </div>
                <div class="text-lg mr-3">⏱️</div>
                <div class="flex items-center flex-1">
                  <span
                    class="w-8 h-8 bg-gradient-to-r from-purple-400 to-indigo-500 text-white text-xs font-bold rounded flex items-center justify-center shadow-sm mr-3"
                  >
                    {{ String(num).padStart(2, "0") }}
                  </span>
                  <span
                    class="text-sm font-medium text-slate-700 dark:text-gray-200"
                  >
                    {{ avg ? `${avg} sorteios` : "N/A" }}
                  </span>
                </div>
              </div>
            </template>
          </div>
        </div>
      </lotto-card>

      <lotto-card
        title="Análise dos Números"
        subtitle="Dicas e avisos baseados na sua seleção"
      >
        <div class="space-y-4">
          <template
            v-for="tip in lottoRaffleTypeAnalisys.response.tips?.result || []"
          >
            <lotto-alert
              :type="tip.type"
              :title="tip.title"
              :text="tip.text"
            />
          </template>
        </div>
      </lotto-card>

      <!-- Card: Frequência dos Números -->
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Frequência dos Números
        </h3>
        <div class="space-y-3">
          <template
            v-for="(freq, idx) in [
              { num: 5, count: 23, percent: 85 },
              { num: 12, count: 31, percent: 95 },
              { num: 23, count: 18, percent: 65 },
              { num: 34, count: 14, percent: 50 },
              { num: 45, count: 27, percent: 88 },
              { num: 58, count: 12, percent: 42 },
            ]"
          >
            <div>
              <div class="flex items-center justify-between mb-1">
                <div class="flex items-center gap-2">
                  <span
                    class="text-xs font-bold text-white rounded px-2 py-0.5"
                    style="background: #209869"
                    >{{ String(freq.num).padStart(2, "0") }}</span
                  >
                  <span class="text-xs text-slate-600 dark:text-gray-300"
                    >{{ freq.count }}x nos últimos 100</span
                  >
                </div>
                <span
                  class="text-xs font-semibold text-slate-700 dark:text-gray-300"
                  >{{ freq.percent }}%</span
                >
              </div>
              <div
                class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-1.5"
              >
                <div
                  class="h-1.5 rounded-full"
                  style="background: #209869"
                  :style="{ width: freq.percent + '%' }"
                ></div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>

    <!-- Seção de Análises Avançadas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Card: Distribuição por Dezenas -->
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Distribuição por Dezenas
        </h3>
        <div class="space-y-3">
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >01-10</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-emerald-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >11-20</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-blue-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >21-30</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-purple-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >31-40</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-amber-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >41-50</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-red-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-xs text-slate-600 dark:text-gray-300"
                >51-60</span
              >
              <span
                class="text-xs font-semibold text-slate-900 dark:text-gray-100"
                >1 número</span
              >
            </div>
            <div class="w-full bg-slate-100 dark:bg-gray-700 rounded-full h-2">
              <div
                class="bg-pink-500 h-2 rounded-full"
                style="width: 17%"
              ></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card: Números Quentes e Frios -->
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Análise de Temperatura
        </h3>
        <div class="space-y-4">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-red-700"
                >🔥 Números Quentes</span
              >
              <span class="text-xs text-slate-500 dark:text-gray-400"
                >Mais sorteados</span
              >
            </div>
            <div class="flex flex-wrap gap-2">
              <span
                class="px-3 py-1 bg-red-100 border border-red-300 text-red-800 dark:text-red-200 rounded-full text-xs font-bold"
                >12</span
              >
              <span
                class="px-3 py-1 bg-red-100 border border-red-300 text-red-800 dark:text-red-200 rounded-full text-xs font-bold"
                >45</span
              >
              <span
                class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
                >23</span
              >
              <span
                class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
                >05</span
              >
            </div>
          </div>
          <div class="border-t border-slate-200 dark:border-gray-700 pt-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-blue-700"
                >❄️ Números Frios</span
              >
              <span class="text-xs text-slate-500 dark:text-gray-400"
                >Menos sorteados</span
              >
            </div>
            <div class="flex flex-wrap gap-2">
              <span
                class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded-full text-xs font-bold"
                >34</span
              >
              <span
                class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded-full text-xs font-bold"
                >58</span
              >
              <span
                class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
                >12</span
              >
              <span
                class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
                >45</span
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card: Histórico de Combinações Similares -->
    <div
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
    >
      <h3 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4">
        Combinações Similares no Histórico
      </h3>
      <div
        class="bg-slate-50 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 rounded-lg p-4 mb-4"
      >
        <div class="flex items-center gap-2 mb-2">
          <svg
            class="w-5 h-5 text-amber-600 dark:text-amber-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          <p class="text-sm font-medium text-slate-900 dark:text-gray-100">
            Esta combinação exata nunca foi sorteada
          </p>
        </div>
        <p class="text-xs text-slate-600 dark:text-gray-300">
          Mas encontramos combinações com 4 números em comum
        </p>
      </div>

      <div class="space-y-3">
        <div
          class="border border-slate-200 dark:border-gray-700 rounded-lg p-4"
        >
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-slate-700 dark:text-gray-300"
              >Concurso 2645 - 21/12/2024</span
            >
            <span
              class="text-xs bg-emerald-100 text-emerald-800 dark:text-emerald-200 px-2 py-0.5 rounded-full font-semibold"
              >4 números iguais</span
            >
          </div>
          <div class="flex flex-wrap gap-1.5">
            <span
              class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded text-xs font-bold"
              >05</span
            >
            <span
              class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded text-xs font-bold"
              >12</span
            >
            <span
              class="px-2 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-300 rounded text-xs"
              >18</span
            >
            <span
              class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded text-xs font-bold"
              >34</span
            >
            <span
              class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded text-xs font-bold"
              >45</span
            >
            <span
              class="px-2 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-300 rounded text-xs"
              >52</span
            >
          </div>
        </div>

        <div
          class="border border-slate-200 dark:border-gray-700 rounded-lg p-4"
        >
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-slate-700 dark:text-gray-300"
              >Concurso 2638 - 14/12/2024</span
            >
            <span
              class="text-xs bg-blue-100 text-blue-800 dark:text-blue-200 px-2 py-0.5 rounded-full font-semibold"
              >3 números iguais</span
            >
          </div>
          <div class="flex flex-wrap gap-1.5">
            <span
              class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded text-xs font-bold"
              >05</span
            >
            <span
              class="px-2 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-300 rounded text-xs"
              >11</span
            >
            <span
              class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded text-xs font-bold"
              >23</span
            >
            <span
              class="px-2 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-300 rounded text-xs"
              >29</span
            >
            <span
              class="px-2 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-300 rounded text-xs"
              >41</span
            >
            <span
              class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded text-xs font-bold"
              >58</span
            >
          </div>
        </div>
      </div>
    </div>

    <!-- Cards de Estatísticas Rápidas -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
      <div
        class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg p-5 text-white shadow-md"
      >
        <div class="text-xs font-medium opacity-90 mb-1">Soma Total</div>
        <div class="text-3xl font-bold">177</div>
        <div class="text-xs opacity-75 mt-1">Média: 29.5</div>
      </div>
      <div
        class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-5 text-white shadow-md"
      >
        <div class="text-xs font-medium opacity-90 mb-1">Sequências</div>
        <div class="text-3xl font-bold">0</div>
        <div class="text-xs opacity-75 mt-1">Nenhuma detectada</div>
      </div>
      <div
        class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-5 text-white shadow-md"
      >
        <div class="text-xs font-medium opacity-90 mb-1">Repetidos</div>
        <div class="text-3xl font-bold">2</div>
        <div class="text-xs opacity-75 mt-1">Últimos 5 concursos</div>
      </div>
      <div
        class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-5 text-white shadow-md"
      >
        <div class="text-xs font-medium opacity-90 mb-1">Score Geral</div>
        <div class="text-3xl font-bold">7.2</div>
        <div class="text-xs opacity-75 mt-1">De 10 pontos</div>
      </div>
    </div>

    <!-- Análise de Tendências e Gaps -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Gráfico de Tendência -->
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Tendência de Sorteios
        </h3>
        <p class="text-xs text-slate-600 dark:text-gray-300 mb-4">
          Frequência dos números selecionados nos últimos 20 concursos
        </p>
        <div class="space-y-3">
          <!-- Gráfico de linha simulado -->
          <div
            class="relative h-40 border-l-2 border-b-2 border-slate-200 dark:border-gray-700"
          >
            <div
              class="absolute bottom-0 left-0 right-0 flex items-end justify-between px-2 h-full"
            >
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-emerald-200 rounded-t"
                  style="height: 75%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >05</span
                >
              </div>
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-blue-200 rounded-t"
                  style="height: 90%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >12</span
                >
              </div>
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-purple-200 rounded-t"
                  style="height: 55%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >23</span
                >
              </div>
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-amber-200 rounded-t"
                  style="height: 42%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >34</span
                >
              </div>
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-red-200 rounded-t"
                  style="height: 82%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >45</span
                >
              </div>
              <div class="flex flex-col items-center gap-1 flex-1">
                <div
                  class="w-full bg-pink-200 rounded-t"
                  style="height: 38%"
                ></div>
                <span class="text-[9px] text-slate-500 dark:text-gray-400"
                  >58</span
                >
              </div>
            </div>
          </div>
          <div
            class="flex items-center justify-between text-xs text-slate-500 dark:text-gray-400"
          >
            <span>Baixa ↓</span>
            <span>Frequência</span>
            <span>↑ Alta</span>
          </div>
        </div>
      </div>

      <!-- Análise de Gaps (intervalos) -->
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Intervalos Entre Sorteios
        </h3>
        <p class="text-xs text-slate-600 dark:text-gray-300 mb-4">
          Quantidade de concursos desde o último sorteio
        </p>
        <div class="space-y-3">
          <template
            v-for="gap in [
              { num: 5, gap: 3, status: 'recent' },
              { num: 12, gap: 1, status: 'hot' },
              { num: 23, gap: 8, status: 'medium' },
              { num: 34, gap: 15, status: 'cold' },
              { num: 45, gap: 2, status: 'recent' },
              { num: 58, gap: 22, status: 'frozen' },
            ]"
          >
            <div class="flex items-center gap-3">
              <span
                class="text-xs font-bold text-white rounded px-2 py-1 w-10 text-center"
                style="background: #209869"
                >{{ String(gap.num).padStart(2, "0") }}</span
              >
              <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                  <span
                    class="text-xs font-medium text-slate-700 dark:text-gray-300"
                    >{{ gap.gap }} concursos atrás</span
                  >
                  <span
                    :class="[
                      'text-[10px] px-2 py-0.5 rounded-full font-semibold',
                      gap.status === 'hot'
                        ? 'bg-red-100 text-red-700'
                        : gap.status === 'recent'
                        ? 'bg-green-100 text-green-700'
                        : gap.status === 'medium'
                        ? 'bg-amber-100 text-amber-700'
                        : gap.status === 'cold'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-slate-100 dark:bg-gray-700 text-slate-700 dark:text-gray-300',
                    ]"
                  >
                    {{
                      gap.status === "hot"
                        ? "Muito recente"
                        : gap.status === "recent"
                        ? "Recente"
                        : gap.status === "medium"
                        ? "Normal"
                        : gap.status === "cold"
                        ? "Atrasado"
                        : "Muito atrasado"
                    }}
                  </span>
                </div>
                <div class="flex gap-0.5">
                  <template v-for="i in 25">
                    <div
                      :class="[
                        'h-1.5 flex-1 rounded-sm',
                        i <= gap.gap
                          ? 'bg-slate-300'
                          : 'bg-slate-100 dark:bg-gray-700',
                      ]"
                    ></div>
                  </template>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>

    <!-- Análise de Primos e Múltiplos -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Números Primos
        </h3>
        <div class="flex items-center justify-center mb-4">
          <div class="relative w-32 h-32">
            <svg class="w-full h-full transform -rotate-90">
              <circle
                cx="64"
                cy="64"
                r="56"
                stroke="#e2e8f0"
                stroke-width="12"
                fill="none"
              />
              <circle
                cx="64"
                cy="64"
                r="56"
                stroke="#209869"
                stroke-width="12"
                fill="none"
                stroke-dasharray="351.86"
                stroke-dashoffset="87.96"
              />
            </svg>
            <div
              class="absolute inset-0 flex flex-col items-center justify-center"
            >
              <span class="text-3xl font-bold text-slate-900 dark:text-gray-100"
                >2</span
              >
              <span class="text-xs text-slate-500 dark:text-gray-400"
                >de 6</span
              >
            </div>
          </div>
        </div>
        <div class="flex flex-wrap gap-2 justify-center">
          <span
            class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded-full text-xs font-bold"
            >05</span
          >
          <span
            class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 dark:text-emerald-200 rounded-full text-xs font-bold"
            >23</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >12</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >34</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >45</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >58</span
          >
        </div>
        <p class="text-xs text-center text-slate-600 dark:text-gray-300 mt-3">
          33% da aposta
        </p>
      </div>

      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Múltiplos de 5
        </h3>
        <div class="flex items-center justify-center mb-4">
          <div class="relative w-32 h-32">
            <svg class="w-full h-full transform -rotate-90">
              <circle
                cx="64"
                cy="64"
                r="56"
                stroke="#e2e8f0"
                stroke-width="12"
                fill="none"
              />
              <circle
                cx="64"
                cy="64"
                r="56"
                stroke="#3b82f6"
                stroke-width="12"
                fill="none"
                stroke-dasharray="351.86"
                stroke-dashoffset="175.93"
              />
            </svg>
            <div
              class="absolute inset-0 flex flex-col items-center justify-center"
            >
              <span class="text-3xl font-bold text-slate-900 dark:text-gray-100"
                >3</span
              >
              <span class="text-xs text-slate-500 dark:text-gray-400"
                >de 6</span
              >
            </div>
          </div>
        </div>
        <div class="flex flex-wrap gap-2 justify-center">
          <span
            class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded-full text-xs font-bold"
            >05</span
          >
          <span
            class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 dark:text-blue-200 rounded-full text-xs font-bold"
            >45</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >12</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >23</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >34</span
          >
          <span
            class="px-3 py-1 bg-slate-100 dark:bg-gray-700 border border-slate-300 text-slate-600 dark:text-gray-300 rounded-full text-xs"
            >58</span
          >
        </div>
        <p class="text-xs text-center text-slate-600 dark:text-gray-300 mt-3">
          50% da aposta
        </p>
      </div>

      <div
        class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
      >
        <h3
          class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4"
        >
          Terminações
        </h3>
        <div class="grid grid-cols-5 gap-2 mb-4">
          <template v-for="term in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]">
            <div
              :class="[
                'aspect-square rounded border-2 flex items-center justify-center text-xs font-bold transition-all',
                [2, 3, 4, 5, 8].includes(term)
                  ? 'border-purple-300 bg-purple-100 text-purple-800'
                  : 'border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-slate-400',
              ]"
            >
              {{ term }}
            </div>
          </template>
        </div>
        <div class="space-y-1.5">
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-600 dark:text-gray-300"
              >Terminações únicas:</span
            >
            <span class="font-semibold text-slate-900 dark:text-gray-100"
              >5 de 6</span
            >
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-600 dark:text-gray-300"
              >Mais frequente:</span
            >
            <span class="font-semibold text-slate-900 dark:text-gray-100"
              >5 (2x)</span
            >
          </div>
        </div>
      </div>
    </div>

    <!-- Heatmap de Correlação -->
    <div
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
    >
      <h3 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-2">
        Matriz de Correlação
      </h3>
      <p class="text-xs text-slate-600 dark:text-gray-300 mb-4">
        Quantas vezes os números selecionados saíram juntos no mesmo concurso
      </p>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse">
          <thead>
            <tr>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              ></th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                05
              </th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                12
              </th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                23
              </th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                34
              </th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                45
              </th>
              <th
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                58
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                05
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                8
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                5
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                2
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                6
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                3
              </td>
            </tr>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                12
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                8
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                4
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                7
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                9
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                5
              </td>
            </tr>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                23
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                5
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                4
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                3
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                6
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                8
              </td>
            </tr>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                34
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                2
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                7
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                3
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                4
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                2
              </td>
            </tr>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                45
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                6
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                9
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                6
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                4
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                7
              </td>
            </tr>
            <tr>
              <td
                class="text-xs font-semibold text-slate-700 dark:text-gray-300 p-2 border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700"
              >
                58
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                3
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                5
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-green-100 font-semibold"
              >
                8
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-red-100 font-semibold"
              >
                2
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-yellow-100 font-semibold"
              >
                7
              </td>
              <td
                class="text-xs text-center p-2 border border-slate-200 dark:border-gray-700 bg-slate-100 dark:bg-gray-700"
              >
                -
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex items-center justify-center gap-4 mt-4 text-xs">
        <div class="flex items-center gap-1.5">
          <div
            class="w-4 h-4 bg-green-100 border border-green-300 rounded"
          ></div>
          <span class="text-slate-600 dark:text-gray-300">Alta (7-9x)</span>
        </div>
        <div class="flex items-center gap-1.5">
          <div
            class="w-4 h-4 bg-yellow-100 border border-yellow-300 rounded"
          ></div>
          <span class="text-slate-600 dark:text-gray-300">Média (4-6x)</span>
        </div>
        <div class="flex items-center gap-1.5">
          <div class="w-4 h-4 bg-red-100 border border-red-300 rounded"></div>
          <span class="text-slate-600 dark:text-gray-300">Baixa (1-3x)</span>
        </div>
      </div>
    </div>

    <!-- Análise de Padrões Visuais -->
    <div
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-6"
    >
      <h3 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-2">
        Padrões Visuais no Volante
      </h3>
      <p class="text-xs text-slate-600 dark:text-gray-300 mb-4">
        Visualização da distribuição espacial dos números selecionados
      </p>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
          <h4
            class="text-sm font-semibold text-slate-700 dark:text-gray-300 mb-3"
          >
            Posições no Volante
          </h4>
          <div class="grid grid-cols-10 gap-1 max-w-md">
            <template v-for="n in 60">
              <div
                :class="[
                  'aspect-square rounded text-[10px] font-bold flex items-center justify-center',
                  [5, 12, 23, 34, 45, 58].includes(n)
                    ? 'text-white'
                    : 'bg-slate-50 dark:bg-gray-700 text-slate-300 border border-slate-100',
                ]"
                :style="
                  [5, 12, 23, 34, 45, 58].includes(n)
                    ? 'background: #209869'
                    : ''
                "
              >
                {{ n }}
              </div>
            </template>
          </div>
        </div>
        <div>
          <h4
            class="text-sm font-semibold text-slate-700 dark:text-gray-300 mb-3"
          >
            Análise de Padrões
          </h4>
          <div class="space-y-3">
            <div
              class="flex items-center justify-between p-3 bg-slate-50 dark:bg-gray-700 rounded-lg"
            >
              <span class="text-xs text-slate-700 dark:text-gray-300"
                >Diagonal detectada</span
              >
              <span class="text-xs font-semibold text-red-600 dark:text-red-400"
                >Não</span
              >
            </div>
            <div
              class="flex items-center justify-between p-3 bg-slate-50 dark:bg-gray-700 rounded-lg"
            >
              <span class="text-xs text-slate-700 dark:text-gray-300"
                >Linha horizontal</span
              >
              <span class="text-xs font-semibold text-red-600 dark:text-red-400"
                >Não</span
              >
            </div>
            <div
              class="flex items-center justify-between p-3 bg-slate-50 dark:bg-gray-700 rounded-lg"
            >
              <span class="text-xs text-slate-700 dark:text-gray-300"
                >Agrupamento</span
              >
              <span
                class="text-xs font-semibold text-amber-600 dark:text-amber-400"
                >Moderado</span
              >
            </div>
            <div
              class="flex items-center justify-between p-3 bg-slate-50 dark:bg-gray-700 rounded-lg"
            >
              <span class="text-xs text-slate-700 dark:text-gray-300"
                >Distribuição espacial</span
              >
              <span class="text-xs font-semibold text-green-600">Boa</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
