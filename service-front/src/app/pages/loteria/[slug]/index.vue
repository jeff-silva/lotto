<template>
  <nuxt-layout name="site-01">
    <template #default="scope">
      <template v-if="lottoRaffleTypeSelect.response">
        <div class="max-w-4xl mx-auto space-y-6">
          <div class="flex items-center gap-3">
            <nuxt-link
              to="/"
              class="text-slate-400 hover:text-slate-600 transition"
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
            </nuxt-link>
            <div class="flex items-center gap-2 flex-1">
              <div
                class="w-1 rounded-sm self-stretch"
                style="background: #209869"
              ></div>
              <div class="flex-1">
                <h1 class="text-3xl font-semibold text-slate-900">
                  {{ lottoRaffleTypeSelect.response.entity.name }}
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                  A maior loteria do Brasil com prêmios que podem mudar sua vida
                </p>
              </div>
            </div>
            <nuxt-link
              :to="`/loteria/${route.params.slug}/aposta`"
              class="inline-flex items-center gap-2 rounded px-5 py-2.5 text-white font-semibold text-sm transition-all hover:opacity-90 shadow-sm"
              style="background: #209869"
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
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                />
              </svg>
              Analisar aposta
            </nuxt-link>
          </div>

          <div class="bg-white border border-slate-200 rounded-md shadow-sm">
            <div
              class="border-b border-slate-200 px-6 py-4"
              style="
                background: linear-gradient(to right, #20986910, transparent);
              "
            >
              <div class="flex items-center justify-between">
                <div>
                  <h2 class="text-lg font-semibold text-slate-900">
                    Último Sorteio
                  </h2>
                  <p class="text-sm text-slate-600 mt-0.5">Concurso 2650</p>
                </div>
                <div class="text-right">
                  <p class="text-xs text-slate-500">Data do sorteio</p>
                  <p class="text-sm font-medium text-slate-700 mt-0.5">
                    28/12/2024
                  </p>
                </div>
              </div>
            </div>

            <div
              v-if="lottoRaffleTypeSelect.response.entity.last_draw"
              class="px-6 py-8"
            >
              <div class="flex justify-center">
                <div class="flex flex-wrap gap-2 justify-center">
                  <template
                    v-for="nn in lottoRaffleTypeSelect.response.entity.last_draw
                      .result"
                  >
                    <div
                      class="w-14 h-14 rounded flex items-center justify-center text-xl font-bold text-white shadow-md"
                      :style="`background: ${lottoRaffleTypeSelect.response.entity.color};`"
                    >
                      {{ nn.toString().padStart(2, "0") }}
                    </div>
                  </template>
                </div>
              </div>
            </div>

            <div class="border-t border-slate-200 px-6 py-4 bg-slate-50">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <p class="text-xs text-slate-500 mb-1">
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
                  <p class="text-xs text-slate-500 mb-1">Próximo sorteio</p>
                  <p class="text-lg font-semibold text-slate-900">
                    Sábado, 20:00
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div
            v-if="lottoRaffleTypeSelect.response.entity.last_draw"
            class="bg-white border border-slate-200 rounded-md shadow-sm"
          >
            <div class="px-6 py-4 border-b border-slate-200">
              <h3 class="text-lg font-semibold text-slate-900">
                Análise dos Números
              </h3>
              <p class="text-sm text-slate-500 mt-0.5">
                Estatísticas detalhadas de cada número sorteado
              </p>
            </div>

            <div class="divide-y divide-slate-200">
              <template
                v-for="nn in lottoRaffleTypeSelect.response.entity.last_draw
                  .result"
              >
                <nuxt-link
                  :to="`/loteria/${route.params.slug}/numero/${nn}`"
                  class="px-6 py-3 flex items-center gap-4 hover:bg-slate-50 transition"
                >
                  <div
                    class="w-12 h-12 rounded flex items-center justify-center text-lg font-bold text-white shadow-sm flex-shrink-0"
                    :style="`background: ${lottoRaffleTypeSelect.response.entity.color};`"
                  >
                    {{ nn.toString().padStart(2, "0") }}
                  </div>
                  <div class="flex-1">
                    <p class="text-sm font-medium text-slate-900">
                      Sorteado 23 vezes nos últimos 100 concursos
                    </p>
                    <p class="text-xs text-slate-500 mt-0.5">
                      Último sorteio há 3 concursos • Frequência: 23%
                    </p>
                  </div>
                </nuxt-link>
              </template>
            </div>
          </div>
        </div>
      </template>
    </template>
  </nuxt-layout>
</template>

<script setup>
const route = useRoute();

const lottoRaffleTypeSelect = useAxios({
  method: "get",
  url: `/api/lotto_raffle_type/${route.params.slug}`,
  params: { with: "lastDraw" },
});

lottoRaffleTypeSelect.submit();
</script>
