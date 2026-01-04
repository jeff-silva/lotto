<template>
  <nuxt-layout name="site-01">
    <template #default="scope">
      <div class="mb-6 lg:mb-8">
        <h2 class="text-2xl lg:text-3xl font-bold text-slate-800 mb-2">
          Últimos Resultados
        </h2>
        <p class="text-slate-500 text-sm lg:text-base">
          Confira os números sorteados mais recentes
        </p>
      </div>

      <div
        class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6"
      >
        <template v-for="type in scope.lottoRaffleTypeSearch.response.data">
          <nuxt-link
            to="/"
            class="group block bg-white rounded-lg p-5 lg:p-6 shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-1"
          >
            <div class="flex items-center justify-between mb-4">
              <div>
                <h3 class="text-base lg:text-lg font-bold text-slate-800">
                  {{ type.name }}
                </h3>
                <template v-if="type.last_draw">
                  <p class="text-xs lg:text-sm text-slate-500">
                    Concurso {{ type.last_draw.number }}
                  </p>
                </template>
              </div>
            </div>

            <template v-if="type.last_draw">
              <div class="flex flex-wrap gap-2 mb-4">
                <template v-for="nn in type.last_draw.result">
                  <div
                    class="w-11 h-11 lg:w-12 lg:h-12 rounded-lg font-bold flex items-center justify-center text-base lg:text-lg text-white"
                    :style="`background: ${type.color}99;`"
                  >
                    {{ nn.toString().padStart(2, "0") }}
                  </div>
                </template>
              </div>

              <div class="flex items-center justify-between pt-4">
                <div>
                  <p class="text-xs text-slate-400 mb-1">Prêmio estimado</p>
                  <p class="text-lg lg:text-xl font-bold text-emerald-600">
                    R$ 35.000.000,00
                  </p>
                </div>
                <svg
                  class="w-5 h-5 text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all flex-shrink-0"
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
              </div>
            </template>
          </nuxt-link>
        </template>
      </div>
    </template>
  </nuxt-layout>
</template>
