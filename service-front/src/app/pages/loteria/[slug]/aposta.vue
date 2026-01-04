<template>
  <nuxt-layout name="site-01">
    <div class="max-w-7xl mx-auto space-y-6">
      <div class="flex items-center gap-3">
        <nuxt-link
          to="/loteria/mega-sena"
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
          <div>
            <h1 class="text-3xl font-semibold text-slate-900">Nova Aposta</h1>
            <p class="text-sm text-slate-500 mt-1">
              Selecione seus números da sorte
            </p>
          </div>
        </div>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm">
        <div
          class="border-b border-slate-200 px-6 py-4"
          style="background: linear-gradient(to right, #20986910, transparent)"
        >
          <div class="flex items-center justify-between">
            <div>
              <div class="flex items-center gap-2 mb-2">
                <span
                  class="inline-flex items-center rounded-full text-white text-xs font-bold px-3 py-1 uppercase tracking-wide"
                  style="background: #209869"
                >
                  Mega-Sena
                </span>
              </div>
              <h2 class="text-lg font-semibold text-slate-900">
                Analisador de Apostas
              </h2>
              <p class="text-sm text-slate-600 mt-0.5">
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
                <div class="text-sm text-slate-600">
                  <span class="text-2xl font-bold text-slate-900">6</span>
                  <span class="text-slate-400 mx-1">/</span>
                  <span class="text-lg font-semibold">6</span>
                  <span class="ml-2 text-slate-500">dezenas selecionadas</span>
                </div>
                <div class="flex gap-3">
                  <button
                    class="inline-flex items-center gap-2 rounded border border-slate-200 bg-white text-slate-700 font-medium text-sm px-4 py-2.5 transition-all hover:bg-red-50 hover:border-red-300 hover:text-red-700"
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

              <table class="w-full border-collapse">
                <tbody>
                  <tr v-for="row in 6" :key="row">
                    <td v-for="col in 10" :key="col" class="p-0.5 w-[10%]">
                      <div class="relative w-full" style="padding-bottom: 100%">
                        <button
                          :class="[
                            'absolute inset-0 w-full h-full rounded border-2 font-bold text-xs transition-all',
                            [5, 12, 23, 34, 45, 58].includes((row - 1) * 10 + col)
                              ? 'border-emerald-500 text-white hover:opacity-90'
                              : 'border-slate-200 bg-white text-slate-700 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-700'
                          ]"
                          :style="[5, 12, 23, 34, 45, 58].includes((row - 1) * 10 + col) ? 'background: #209869' : ''"
                        >
                          {{ String((row - 1) * 10 + col).padStart(2, '0') }}
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Painéis de Alertas -->
            <div class="space-y-4">
              <h3 class="text-sm font-semibold text-slate-700 mb-4">Análise da Aposta</h3>
              
              <!-- Alerta de Aviso -->
              <div class="border border-amber-200 bg-amber-50 rounded-lg p-4">
                <div class="flex gap-3">
                  <div class="flex-shrink-0">
                    <svg
                      class="w-5 h-5 text-amber-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                      />
                    </svg>
                  </div>
                  <div class="flex-1">
                    <p class="text-xs font-semibold text-amber-900 mb-1">Número Repetido</p>
                    <p class="text-xs text-amber-800">
                      O número <strong>12</strong> saiu nos últimos 2 concursos consecutivos
                    </p>
                  </div>
                </div>
              </div>

              <!-- Alerta de Erro -->
              <div class="border border-red-200 bg-red-50 rounded-lg p-4">
                <div class="flex gap-3">
                  <div class="flex-shrink-0">
                    <svg
                      class="w-5 h-5 text-red-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </div>
                  <div class="flex-1">
                    <p class="text-xs font-semibold text-red-900 mb-1">Padrão Perigoso</p>
                    <p class="text-xs text-red-800">
                      Números muito próximos: <strong>34, 45</strong> podem reduzir chances
                    </p>
                  </div>
                </div>
              </div>

              <!-- Alerta de Dica -->
              <div class="border border-blue-200 bg-blue-50 rounded-lg p-4">
                <div class="flex gap-3">
                  <div class="flex-shrink-0">
                    <svg
                      class="w-5 h-5 text-blue-600"
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
                  </div>
                  <div class="flex-1">
                    <p class="text-xs font-semibold text-blue-900 mb-1">Sugestão</p>
                    <p class="text-xs text-blue-800">
                      Considere incluir números acima de 40 para melhor distribuição
                    </p>
                  </div>
                </div>
              </div>

              <!-- Alerta de Sucesso -->
              <div class="border border-emerald-200 bg-emerald-50 rounded-lg p-4">
                <div class="flex gap-3">
                  <div class="flex-shrink-0">
                    <svg
                      class="w-5 h-5 text-emerald-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </div>
                  <div class="flex-1">
                    <p class="text-xs font-semibold text-emerald-900 mb-1">Boa Distribuição</p>
                    <p class="text-xs text-emerald-800">
                      Números bem distribuídos entre dezenas baixas e altas
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="bg-blue-50 border border-blue-200 rounded-md px-6 py-4 flex items-start gap-3"
      >
        <svg
          class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"
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
        <div>
          <p class="text-sm font-medium text-blue-900">Como apostar</p>
          <p class="text-xs text-blue-700 mt-1">
            Selecione de 6 a 15 números dentre os 60 disponíveis. Quanto mais
            números você escolher, maior o valor da aposta.
          </p>
        </div>
      </div>
    </div>
  </nuxt-layout>
</template>