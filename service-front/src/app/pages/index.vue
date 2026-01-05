<template>
  <nuxt-layout name="site-01">
    <template #default="scope">
      <div class="max-w-6xl mx-auto space-y-6">
        <div class="border-l-4 pl-4" style="border-color: #10b981;">
          <h2 class="text-2xl font-semibold text-slate-900 dark:text-gray-100">
            Últimos Resultados
          </h2>
          <p class="text-slate-600 dark:text-gray-300 text-sm mt-1">
            Confira os números sorteados mais recentes
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
          <template v-for="type in scope.lottoRaffleTypeSearch.response.data" :key="type.id">
            <nuxt-link
              :to="`/loteria/${type.slug}`"
              class="group bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 hover:border-slate-300 dark:hover:border-gray-600 transition-all rounded-md shadow-sm hover:shadow-md"
            >
              <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <div class="w-1 h-8 rounded-sm" :style="`background: ${type.color};`"></div>
                    <div>
                      <h3 class="text-base font-semibold text-slate-900 dark:text-gray-100">
                        {{ type.name }}
                      </h3>
                      <template v-if="type.last_draw">
                        <p class="text-xs text-slate-500 dark:text-gray-400">
                          Concurso {{ type.last_draw.number }}
                        </p>
                      </template>
                    </div>
                  </div>
                  
                  <svg class="w-4 h-4 text-slate-400 dark:text-gray-500 group-hover:text-slate-600 dark:group-hover:text-gray-300 dark:text-gray-300 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </div>

                <template v-if="type.last_draw">
                  <div class="mb-3">
                    <div class="flex flex-wrap gap-1.5">
                      <template v-for="nn in type.last_draw.result" :key="nn">
                        <div
                          class="w-8 h-8 rounded flex items-center justify-center text-xs font-semibold text-white shadow-sm"
                          :style="`background: ${type.color};`"
                        >
                          {{ nn.toString().padStart(2, "0") }}
                        </div>
                      </template>
                    </div>
                  </div>

                  <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-gray-700">
                    <div>
                      <p class="text-xs text-slate-500 dark:text-gray-400">Próximo prêmio</p>
                      <p class="text-sm font-semibold text-slate-900 dark:text-gray-100 mt-0.5">
                        R$ 35.000.000
                      </p>
                    </div>
                    <div class="text-right">
                      <p class="text-xs text-slate-500 dark:text-gray-400">Próximo sorteio</p>
                      <p class="text-sm font-medium text-slate-700 dark:text-gray-300 mt-0.5">
                        Sáb, 20:00
                      </p>
                    </div>
                  </div>
                </template>
              </div>
            </nuxt-link>
          </template>
        </div>
      </div>
    </template>
  </nuxt-layout>
</template>
