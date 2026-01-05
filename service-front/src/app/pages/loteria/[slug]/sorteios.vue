<template>
  <div class="space-y-4">
    <!-- Visualizador de Sorteio com Grid de Números -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
      <!-- Cabeçalho com informações do sorteio -->
      <div
        class="flex flex-col sm:flex-row items-center justify-between gap-3 mb-4"
      >
        <div class="flex items-center gap-3">
          <button
            @click="previousDraw"
            class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors disabled:opacity-40 disabled:cursor-not-allowed"
            :disabled="currentDrawIndex >= mockDraws.length - 1"
          >
            <svg
              class="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 19l-7-7 7-7"
              />
            </svg>
          </button>

          <div class="text-center">
            <span
              class="inline-flex items-center rounded-full text-white text-sm font-bold px-4 py-1.5"
              :style="`background: ${lottoColor}`"
            >
              Concurso {{ currentDraw.number }}
            </span>
            <p class="text-xs text-slate-600 mt-1">
              {{ currentDraw.date }} - {{ currentDraw.weekday }}
            </p>
          </div>

          <button
            @click="nextDraw"
            class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors disabled:opacity-40 disabled:cursor-not-allowed"
            :disabled="currentDrawIndex <= 0"
          >
            <svg
              class="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
              />
            </svg>
          </button>
        </div>

        <!-- Input para ir direto ao concurso -->
        <div class="flex items-center gap-2">
          <label class="text-sm text-slate-600 whitespace-nowrap"
            >Ir para:</label
          >
          <input
            v-model="drawNumberInput"
            @keyup.enter="goToDrawNumber"
            type="number"
            placeholder="Nº"
            class="w-24 px-3 py-1.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400"
          />
          <button
            @click="goToDrawNumber"
            class="px-3 py-1.5 text-sm font-medium text-white rounded-lg hover:opacity-90 transition-opacity"
            :style="`background: ${lottoColor}`"
          >
            Ir
          </button>
        </div>
      </div>

      <div class="mb-4">
        <lotto-numbers-selector
          :color="scope.lottoRaffleTypeSelect.response.entity.color"
        />
      </div>

      <!-- Informações Adicionais do Sorteio -->
      <div
        class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-3 border-t border-slate-200"
      >
        <div class="text-center">
          <p class="text-xs text-slate-500 mb-0.5">Prêmio</p>
          <p class="text-sm font-bold text-slate-900">
            {{ currentDraw.prize }}
          </p>
        </div>
        <div class="text-center">
          <p class="text-xs text-slate-500 mb-0.5">Ganhadores (6)</p>
          <p
            class="text-sm font-semibold"
            :style="`color: ${lottoColor}`"
          >
            {{ currentDraw.winners }}
          </p>
        </div>
        <div class="text-center">
          <p class="text-xs text-slate-500 mb-0.5">Arrecadação</p>
          <p class="text-sm font-semibold text-slate-900">
            {{ currentDraw.stats.revenue }}
          </p>
        </div>
        <div class="text-center">
          <p class="text-xs text-slate-500 mb-0.5">Status</p>
          <p
            class="text-sm font-semibold"
            :class="currentDraw.accumulated ? 'text-red-600' : 'text-green-600'"
          >
            {{ currentDraw.accumulated ? "Acumulou" : "Pago" }}
          </p>
        </div>
      </div>
    </div>

    <!-- Paginação -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-slate-600">
          Mostrando <span class="font-medium text-slate-900">1-10</span> de
          <span class="font-medium text-slate-900">2.650</span> concursos
        </div>
        <nav class="flex items-center gap-2">
          <button
            class="px-3 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed"
            disabled
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
                d="M15 19l-7-7 7-7"
              />
            </svg>
          </button>
          <button
            class="px-4 py-2 border-2 rounded-lg text-sm font-medium text-white"
            :style="`background: ${
              props.scope.lottoRaffleTypeSelect?.response?.entity?.color ||
              '#209869'
            }; border-color: ${
              props.scope.lottoRaffleTypeSelect?.response?.entity?.color ||
              '#209869'
            }`"
          >
            1
          </button>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            2
          </button>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            3
          </button>
          <span class="px-2 text-slate-400">...</span>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            265
          </button>
          <button
            class="px-3 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
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
                d="M9 5l7 7-7 7"
              />
            </svg>
          </button>
        </nav>
      </div>
    </div>

    <!-- Lista de Sorteios -->
    <div class="space-y-3">
      <template
        v-for="draw in mockDraws"
        :key="draw.id"
      >
        <div
          class="bg-white border border-slate-200 rounded-md shadow-sm hover:shadow-md transition-shadow overflow-hidden"
        >
          <div class="p-4">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
              <!-- Info do Concurso -->
              <div class="flex-shrink-0">
                <div class="flex items-center gap-2 mb-1">
                  <span
                    class="inline-flex items-center rounded-full text-white text-xs font-bold px-2.5 py-0.5"
                    :style="`background: ${
                      props.scope.lottoRaffleTypeSelect?.response?.entity
                        ?.color || '#209869'
                    }`"
                  >
                    Concurso {{ draw.number }}
                  </span>
                  <span class="text-xs text-slate-500">{{ draw.date }}</span>
                </div>
                <div class="text-sm text-slate-600">
                  <span class="font-medium">{{ draw.weekday }}</span>
                </div>
              </div>

              <!-- Números Sorteados -->
              <div class="flex-1">
                <div
                  class="flex flex-wrap gap-1.5 justify-center lg:justify-start"
                >
                  <template v-for="num in draw.numbers">
                    <div
                      class="w-9 h-9 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
                      :style="`background: ${
                        props.scope.lottoRaffleTypeSelect?.response?.entity
                          ?.color || '#209869'
                      }`"
                    >
                      {{ String(num).padStart(2, "0") }}
                    </div>
                  </template>
                </div>
              </div>

              <!-- Prêmio e Ganhadores -->
              <div
                class="flex-shrink-0 border-t lg:border-t-0 lg:border-l border-slate-200 pt-3 lg:pt-0 lg:pl-4"
              >
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-3">
                  <div>
                    <p class="text-xs text-slate-500 mb-0.5">Prêmio</p>
                    <p class="text-base font-bold text-slate-900">
                      {{ draw.prize }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500 mb-0.5">
                      Ganhadores (6 acertos)
                    </p>
                    <p
                      class="text-sm font-semibold"
                      :style="`color: ${
                        props.scope.lottoRaffleTypeSelect?.response?.entity
                          ?.color || '#209869'
                      }`"
                    >
                      {{ draw.winners }}
                    </p>
                  </div>
                </div>
              </div>

              <!-- Ações -->
              <div class="flex-shrink-0 flex lg:flex-col gap-1.5">
                <button
                  class="flex-1 lg:flex-none inline-flex items-center justify-center gap-1.5 px-3 py-1.5 border border-slate-200 rounded-lg text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors"
                >
                  <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    />
                  </svg>
                  Detalhes
                </button>
                <button
                  class="flex-1 lg:flex-none inline-flex items-center justify-center gap-1.5 px-3 py-1.5 border border-slate-200 rounded-lg text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors"
                >
                  <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                    />
                  </svg>
                  Analisar
                </button>
              </div>
            </div>

            <!-- Estatísticas Expandidas (opcional) -->
            <div
              class="mt-3 pt-3 border-t border-slate-200 grid grid-cols-2 md:grid-cols-4 gap-3 text-center"
            >
              <div>
                <p class="text-xs text-slate-500 mb-0.5">5 acertos</p>
                <p class="text-sm font-semibold text-slate-900">
                  {{ draw.stats.five }}
                </p>
              </div>
              <div>
                <p class="text-xs text-slate-500 mb-0.5">4 acertos</p>
                <p class="text-sm font-semibold text-slate-900">
                  {{ draw.stats.four }}
                </p>
              </div>
              <div>
                <p class="text-xs text-slate-500 mb-0.5">Arrecadação</p>
                <p class="text-sm font-semibold text-slate-900">
                  {{ draw.stats.revenue }}
                </p>
              </div>
              <div>
                <p class="text-xs text-slate-500 mb-0.5">Acumulado</p>
                <p
                  class="text-sm font-semibold"
                  :class="draw.accumulated ? 'text-red-600' : 'text-green-600'"
                >
                  {{ draw.accumulated ? "Sim" : "Não" }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- Paginação -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-slate-600">
          Mostrando <span class="font-medium text-slate-900">1-10</span> de
          <span class="font-medium text-slate-900">2.650</span> concursos
        </div>
        <nav class="flex items-center gap-2">
          <button
            class="px-3 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed"
            disabled
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
                d="M15 19l-7-7 7-7"
              />
            </svg>
          </button>
          <button
            class="px-4 py-2 border-2 rounded-lg text-sm font-medium text-white"
            :style="`background: ${
              props.scope.lottoRaffleTypeSelect?.response?.entity?.color ||
              '#209869'
            }; border-color: ${
              props.scope.lottoRaffleTypeSelect?.response?.entity?.color ||
              '#209869'
            }`"
          >
            1
          </button>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            2
          </button>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            3
          </button>
          <span class="px-2 text-slate-400">...</span>
          <button
            class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
          >
            265
          </button>
          <button
            class="px-3 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50"
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
                d="M9 5l7 7-7 7"
              />
            </svg>
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});

// Estado para navegação do sorteio
const currentDrawIndex = ref(0);
const drawNumberInput = ref("");

// Computed para o sorteio atual
const currentDraw = computed(() => mockDraws[currentDrawIndex.value]);

// Computed para a cor da loteria
const lottoColor = computed(() => {
  return (
    props.scope.lottoRaffleTypeSelect?.response?.entity?.color || "#209869"
  );
});

// Funções de navegação
const nextDraw = () => {
  if (currentDrawIndex.value > 0) {
    currentDrawIndex.value--;
  }
};

const previousDraw = () => {
  if (currentDrawIndex.value < mockDraws.length - 1) {
    currentDrawIndex.value++;
  }
};

const goToDrawNumber = () => {
  const drawNumber = parseInt(drawNumberInput.value);
  if (drawNumber) {
    const index = mockDraws.findIndex((draw) => draw.number === drawNumber);
    if (index !== -1) {
      currentDrawIndex.value = index;
      drawNumberInput.value = "";
    }
  }
};

// Verifica se um número foi sorteado
const isNumberDrawn = (num) => {
  return currentDraw.value.numbers.includes(num);
};

// Mock data para demonstração
const mockDraws = [
  {
    id: 1,
    number: 2650,
    date: "28/12/2024",
    weekday: "Sábado",
    numbers: [5, 12, 23, 34, 45, 58],
    prize: "R$ 3.500.000,00",
    winners: "2 ganhadores",
    stats: {
      five: "154 ganhadores",
      four: "8.235 ganhadores",
      revenue: "R$ 125.000.000",
    },
    accumulated: false,
  },
  {
    id: 2,
    number: 2649,
    date: "26/12/2024",
    weekday: "Quinta-feira",
    numbers: [3, 18, 27, 41, 52, 60],
    prize: "R$ 0,00",
    winners: "0 ganhadores",
    stats: {
      five: "89 ganhadores",
      four: "6.541 ganhadores",
      revenue: "R$ 98.000.000",
    },
    accumulated: true,
  },
  {
    id: 3,
    number: 2648,
    date: "24/12/2024",
    weekday: "Terça-feira",
    numbers: [7, 14, 29, 35, 48, 56],
    prize: "R$ 12.000.000,00",
    winners: "1 ganhador",
    stats: {
      five: "201 ganhadores",
      four: "9.874 ganhadores",
      revenue: "R$ 142.000.000",
    },
    accumulated: false,
  },
  {
    id: 4,
    number: 2647,
    date: "21/12/2024",
    weekday: "Sábado",
    numbers: [2, 11, 25, 38, 44, 59],
    prize: "R$ 0,00",
    winners: "0 ganhadores",
    stats: {
      five: "112 ganhadores",
      four: "7.329 ganhadores",
      revenue: "R$ 105.000.000",
    },
    accumulated: true,
  },
  {
    id: 5,
    number: 2646,
    date: "19/12/2024",
    weekday: "Quinta-feira",
    numbers: [9, 16, 31, 42, 49, 57],
    prize: "R$ 8.500.000,00",
    winners: "3 ganhadores",
    stats: {
      five: "178 ganhadores",
      four: "8.652 ganhadores",
      revenue: "R$ 128.000.000",
    },
    accumulated: false,
  },
  {
    id: 6,
    number: 2645,
    date: "17/12/2024",
    weekday: "Terça-feira",
    numbers: [1, 13, 22, 36, 47, 55],
    prize: "R$ 0,00",
    winners: "0 ganhadores",
    stats: {
      five: "95 ganhadores",
      four: "6.841 ganhadores",
      revenue: "R$ 92.000.000",
    },
    accumulated: true,
  },
  {
    id: 7,
    number: 2644,
    date: "14/12/2024",
    weekday: "Sábado",
    numbers: [4, 17, 28, 39, 50, 54],
    prize: "R$ 15.000.000,00",
    winners: "2 ganhadores",
    stats: {
      five: "234 ganhadores",
      four: "10.125 ganhadores",
      revenue: "R$ 158.000.000",
    },
    accumulated: false,
  },
  {
    id: 8,
    number: 2643,
    date: "12/12/2024",
    weekday: "Quinta-feira",
    numbers: [6, 19, 26, 40, 46, 53],
    prize: "R$ 0,00",
    winners: "0 ganhadores",
    stats: {
      five: "127 ganhadores",
      four: "7.982 ganhadores",
      revenue: "R$ 112.000.000",
    },
    accumulated: true,
  },
  {
    id: 9,
    number: 2642,
    date: "10/12/2024",
    weekday: "Terça-feira",
    numbers: [8, 15, 24, 37, 43, 51],
    prize: "R$ 6.200.000,00",
    winners: "4 ganhadores",
    stats: {
      five: "189 ganhadores",
      four: "9.214 ganhadores",
      revenue: "R$ 135.000.000",
    },
    accumulated: false,
  },
  {
    id: 10,
    number: 2641,
    date: "07/12/2024",
    weekday: "Sábado",
    numbers: [10, 20, 30, 33, 41, 60],
    prize: "R$ 0,00",
    winners: "0 ganhadores",
    stats: {
      five: "142 ganhadores",
      four: "8.457 ganhadores",
      revenue: "R$ 118.000.000",
    },
    accumulated: true,
  },
];
</script>
