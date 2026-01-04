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

      <!-- Seção de Análises Estatísticas -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Card: Resumo Geral -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Resumo da Aposta</h3>
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-sm text-slate-600">Valor da aposta</span>
              <span class="text-2xl font-bold" style="color: #209869">R$ 4,50</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm text-slate-600">Probabilidade</span>
              <span class="text-lg font-semibold text-slate-900">1 em 50.063.860</span>
            </div>
            <div class="border-t border-slate-200 pt-4 mt-4">
              <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-slate-500">Confiança da seleção</span>
                <span class="text-xs font-bold text-amber-600">68%</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-amber-500 h-2 rounded-full" style="width: 68%"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Card: Frequência dos Números -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Frequência dos Números</h3>
          <div class="space-y-3">
            <template v-for="(freq, idx) in [
              { num: 5, count: 23, percent: 85 },
              { num: 12, count: 31, percent: 95 },
              { num: 23, count: 18, percent: 65 },
              { num: 34, count: 14, percent: 50 },
              { num: 45, count: 27, percent: 88 },
              { num: 58, count: 12, percent: 42 }
            ]">
              <div>
                <div class="flex items-center justify-between mb-1">
                  <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-white rounded px-2 py-0.5" style="background: #209869">{{ String(freq.num).padStart(2, '0') }}</span>
                    <span class="text-xs text-slate-600">{{ freq.count }}x nos últimos 100</span>
                  </div>
                  <span class="text-xs font-semibold text-slate-700">{{ freq.percent }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-1.5">
                  <div class="h-1.5 rounded-full" style="background: #209869" :style="{ width: freq.percent + '%' }"></div>
                </div>
              </div>
            </template>
          </div>
        </div>

        <!-- Card: Distribuição Par/Ímpar -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Distribuição Par/Ímpar</h3>
          <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
              <div class="text-3xl font-bold text-blue-900">4</div>
              <div class="text-xs text-blue-600 mt-1">Pares</div>
            </div>
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
              <div class="text-3xl font-bold text-purple-900">2</div>
              <div class="text-xs text-purple-600 mt-1">Ímpares</div>
            </div>
          </div>
          <div class="flex gap-1 mb-2">
            <div class="flex-1 bg-blue-500 h-3 rounded"></div>
            <div class="flex-1 bg-blue-500 h-3 rounded"></div>
            <div class="flex-1 bg-blue-500 h-3 rounded"></div>
            <div class="flex-1 bg-blue-500 h-3 rounded"></div>
            <div class="flex-1 bg-purple-500 h-3 rounded"></div>
            <div class="flex-1 bg-purple-500 h-3 rounded"></div>
          </div>
          <p class="text-xs text-slate-600 text-center">
            Distribuição equilibrada recomendada: 3 pares e 3 ímpares
          </p>
        </div>
      </div>

      <!-- Seção de Análises Avançadas -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Card: Distribuição por Dezenas -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Distribuição por Dezenas</h3>
          <div class="space-y-3">
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">01-10</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">11-20</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">21-30</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-purple-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">31-40</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-amber-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">41-50</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">51-60</span>
                <span class="text-xs font-semibold text-slate-900">1 número</span>
              </div>
              <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-pink-500 h-2 rounded-full" style="width: 17%"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Card: Números Quentes e Frios -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Análise de Temperatura</h3>
          <div class="space-y-4">
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-red-700">🔥 Números Quentes</span>
                <span class="text-xs text-slate-500">Mais sorteados</span>
              </div>
              <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-red-100 border border-red-300 text-red-800 rounded-full text-xs font-bold">12</span>
                <span class="px-3 py-1 bg-red-100 border border-red-300 text-red-800 rounded-full text-xs font-bold">45</span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">23</span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">05</span>
              </div>
            </div>
            <div class="border-t border-slate-200 pt-4">
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-blue-700">❄️ Números Frios</span>
                <span class="text-xs text-slate-500">Menos sorteados</span>
              </div>
              <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded-full text-xs font-bold">34</span>
                <span class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded-full text-xs font-bold">58</span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">12</span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">45</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card: Histórico de Combinações Similares -->
      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
        <h3 class="text-lg font-semibold text-slate-900 mb-4">Combinações Similares no Histórico</h3>
        <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mb-4">
          <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium text-slate-900">Esta combinação exata nunca foi sorteada</p>
          </div>
          <p class="text-xs text-slate-600">Mas encontramos combinações com 4 números em comum</p>
        </div>
        
        <div class="space-y-3">
          <div class="border border-slate-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-medium text-slate-700">Concurso 2645 - 21/12/2024</span>
              <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-semibold">4 números iguais</span>
            </div>
            <div class="flex flex-wrap gap-1.5">
              <span class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded text-xs font-bold">05</span>
              <span class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded text-xs font-bold">12</span>
              <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded text-xs">18</span>
              <span class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded text-xs font-bold">34</span>
              <span class="px-2 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded text-xs font-bold">45</span>
              <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded text-xs">52</span>
            </div>
          </div>

          <div class="border border-slate-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-medium text-slate-700">Concurso 2638 - 14/12/2024</span>
              <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-semibold">3 números iguais</span>
            </div>
            <div class="flex flex-wrap gap-1.5">
              <span class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded text-xs font-bold">05</span>
              <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded text-xs">11</span>
              <span class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded text-xs font-bold">23</span>
              <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded text-xs">29</span>
              <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded text-xs">41</span>
              <span class="px-2 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded text-xs font-bold">58</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Cards de Estatísticas Rápidas -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg p-5 text-white shadow-md">
          <div class="text-xs font-medium opacity-90 mb-1">Soma Total</div>
          <div class="text-3xl font-bold">177</div>
          <div class="text-xs opacity-75 mt-1">Média: 29.5</div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-5 text-white shadow-md">
          <div class="text-xs font-medium opacity-90 mb-1">Sequências</div>
          <div class="text-3xl font-bold">0</div>
          <div class="text-xs opacity-75 mt-1">Nenhuma detectada</div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-5 text-white shadow-md">
          <div class="text-xs font-medium opacity-90 mb-1">Repetidos</div>
          <div class="text-3xl font-bold">2</div>
          <div class="text-xs opacity-75 mt-1">Últimos 5 concursos</div>
        </div>
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-5 text-white shadow-md">
          <div class="text-xs font-medium opacity-90 mb-1">Score Geral</div>
          <div class="text-3xl font-bold">7.2</div>
          <div class="text-xs opacity-75 mt-1">De 10 pontos</div>
        </div>
      </div>

      <!-- Análise de Tendências e Gaps -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gráfico de Tendência -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Tendência de Sorteios</h3>
          <p class="text-xs text-slate-600 mb-4">Frequência dos números selecionados nos últimos 20 concursos</p>
          <div class="space-y-3">
            <!-- Gráfico de linha simulado -->
            <div class="relative h-40 border-l-2 border-b-2 border-slate-200">
              <div class="absolute bottom-0 left-0 right-0 flex items-end justify-between px-2 h-full">
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-emerald-200 rounded-t" style="height: 75%"></div>
                  <span class="text-[9px] text-slate-500">05</span>
                </div>
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-blue-200 rounded-t" style="height: 90%"></div>
                  <span class="text-[9px] text-slate-500">12</span>
                </div>
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-purple-200 rounded-t" style="height: 55%"></div>
                  <span class="text-[9px] text-slate-500">23</span>
                </div>
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-amber-200 rounded-t" style="height: 42%"></div>
                  <span class="text-[9px] text-slate-500">34</span>
                </div>
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-red-200 rounded-t" style="height: 82%"></div>
                  <span class="text-[9px] text-slate-500">45</span>
                </div>
                <div class="flex flex-col items-center gap-1 flex-1">
                  <div class="w-full bg-pink-200 rounded-t" style="height: 38%"></div>
                  <span class="text-[9px] text-slate-500">58</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between text-xs text-slate-500">
              <span>Baixa ↓</span>
              <span>Frequência</span>
              <span>↑ Alta</span>
            </div>
          </div>
        </div>

        <!-- Análise de Gaps (intervalos) -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Intervalos Entre Sorteios</h3>
          <p class="text-xs text-slate-600 mb-4">Quantidade de concursos desde o último sorteio</p>
          <div class="space-y-3">
            <template v-for="gap in [
              { num: 5, gap: 3, status: 'recent' },
              { num: 12, gap: 1, status: 'hot' },
              { num: 23, gap: 8, status: 'medium' },
              { num: 34, gap: 15, status: 'cold' },
              { num: 45, gap: 2, status: 'recent' },
              { num: 58, gap: 22, status: 'frozen' }
            ]">
              <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-white rounded px-2 py-1 w-10 text-center" style="background: #209869">{{ String(gap.num).padStart(2, '0') }}</span>
                <div class="flex-1">
                  <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-700">{{ gap.gap }} concursos atrás</span>
                    <span 
                      :class="[
                        'text-[10px] px-2 py-0.5 rounded-full font-semibold',
                        gap.status === 'hot' ? 'bg-red-100 text-red-700' : 
                        gap.status === 'recent' ? 'bg-green-100 text-green-700' :
                        gap.status === 'medium' ? 'bg-amber-100 text-amber-700' :
                        gap.status === 'cold' ? 'bg-blue-100 text-blue-700' :
                        'bg-slate-100 text-slate-700'
                      ]"
                    >
                      {{ 
                        gap.status === 'hot' ? 'Muito recente' : 
                        gap.status === 'recent' ? 'Recente' :
                        gap.status === 'medium' ? 'Normal' :
                        gap.status === 'cold' ? 'Atrasado' :
                        'Muito atrasado'
                      }}
                    </span>
                  </div>
                  <div class="flex gap-0.5">
                    <template v-for="i in 25">
                      <div 
                        :class="[
                          'h-1.5 flex-1 rounded-sm',
                          i <= gap.gap ? 'bg-slate-300' : 'bg-slate-100'
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
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Números Primos</h3>
          <div class="flex items-center justify-center mb-4">
            <div class="relative w-32 h-32">
              <svg class="w-full h-full transform -rotate-90">
                <circle cx="64" cy="64" r="56" stroke="#e2e8f0" stroke-width="12" fill="none" />
                <circle cx="64" cy="64" r="56" stroke="#209869" stroke-width="12" fill="none" 
                  stroke-dasharray="351.86" stroke-dashoffset="87.96" />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-3xl font-bold text-slate-900">2</span>
                <span class="text-xs text-slate-500">de 6</span>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap gap-2 justify-center">
            <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-full text-xs font-bold">05</span>
            <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-full text-xs font-bold">23</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">12</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">34</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">45</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">58</span>
          </div>
          <p class="text-xs text-center text-slate-600 mt-3">33% da aposta</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Múltiplos de 5</h3>
          <div class="flex items-center justify-center mb-4">
            <div class="relative w-32 h-32">
              <svg class="w-full h-full transform -rotate-90">
                <circle cx="64" cy="64" r="56" stroke="#e2e8f0" stroke-width="12" fill="none" />
                <circle cx="64" cy="64" r="56" stroke="#3b82f6" stroke-width="12" fill="none" 
                  stroke-dasharray="351.86" stroke-dashoffset="175.93" />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-3xl font-bold text-slate-900">3</span>
                <span class="text-xs text-slate-500">de 6</span>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap gap-2 justify-center">
            <span class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded-full text-xs font-bold">05</span>
            <span class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-800 rounded-full text-xs font-bold">45</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">12</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">23</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">34</span>
            <span class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-600 rounded-full text-xs">58</span>
          </div>
          <p class="text-xs text-center text-slate-600 mt-3">50% da aposta</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Terminações</h3>
          <div class="grid grid-cols-5 gap-2 mb-4">
            <template v-for="term in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]">
              <div 
                :class="[
                  'aspect-square rounded border-2 flex items-center justify-center text-xs font-bold transition-all',
                  [2, 3, 4, 5, 8].includes(term) 
                    ? 'border-purple-300 bg-purple-100 text-purple-800'
                    : 'border-slate-200 bg-white text-slate-400'
                ]"
              >
                {{ term }}
              </div>
            </template>
          </div>
          <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-600">Terminações únicas:</span>
              <span class="font-semibold text-slate-900">5 de 6</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-600">Mais frequente:</span>
              <span class="font-semibold text-slate-900">5 (2x)</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Heatmap de Correlação -->
      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
        <h3 class="text-lg font-semibold text-slate-900 mb-2">Matriz de Correlação</h3>
        <p class="text-xs text-slate-600 mb-4">Quantas vezes os números selecionados saíram juntos no mesmo concurso</p>
        <div class="overflow-x-auto">
          <table class="w-full border-collapse">
            <thead>
              <tr>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50"></th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">05</th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">12</th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">23</th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">34</th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">45</th>
                <th class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">58</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">05</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">8</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">5</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">2</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">6</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">3</td>
              </tr>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">12</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">8</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">4</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">7</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">9</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">5</td>
              </tr>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">23</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">5</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">4</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">3</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">6</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">8</td>
              </tr>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">34</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">2</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">7</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">3</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">4</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">2</td>
              </tr>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">45</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">6</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">9</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">6</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">4</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">7</td>
              </tr>
              <tr>
                <td class="text-xs font-semibold text-slate-700 p-2 border border-slate-200 bg-slate-50">58</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">3</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">5</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-green-100 font-semibold">8</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-red-100 font-semibold">2</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-yellow-100 font-semibold">7</td>
                <td class="text-xs text-center p-2 border border-slate-200 bg-slate-100">-</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex items-center justify-center gap-4 mt-4 text-xs">
          <div class="flex items-center gap-1.5">
            <div class="w-4 h-4 bg-green-100 border border-green-300 rounded"></div>
            <span class="text-slate-600">Alta (7-9x)</span>
          </div>
          <div class="flex items-center gap-1.5">
            <div class="w-4 h-4 bg-yellow-100 border border-yellow-300 rounded"></div>
            <span class="text-slate-600">Média (4-6x)</span>
          </div>
          <div class="flex items-center gap-1.5">
            <div class="w-4 h-4 bg-red-100 border border-red-300 rounded"></div>
            <span class="text-slate-600">Baixa (1-3x)</span>
          </div>
        </div>
      </div>

      <!-- Análise de Padrões Visuais -->
      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">
        <h3 class="text-lg font-semibold text-slate-900 mb-2">Padrões Visuais no Volante</h3>
        <p class="text-xs text-slate-600 mb-4">Visualização da distribuição espacial dos números selecionados</p>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div>
            <h4 class="text-sm font-semibold text-slate-700 mb-3">Posições no Volante</h4>
            <div class="grid grid-cols-10 gap-1 max-w-md">
              <template v-for="n in 60">
                <div 
                  :class="[
                    'aspect-square rounded text-[10px] font-bold flex items-center justify-center',
                    [5, 12, 23, 34, 45, 58].includes(n)
                      ? 'text-white'
                      : 'bg-slate-50 text-slate-300 border border-slate-100'
                  ]"
                  :style="[5, 12, 23, 34, 45, 58].includes(n) ? 'background: #209869' : ''"
                >
                  {{ n }}
                </div>
              </template>
            </div>
          </div>
          <div>
            <h4 class="text-sm font-semibold text-slate-700 mb-3">Análise de Padrões</h4>
            <div class="space-y-3">
              <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <span class="text-xs text-slate-700">Diagonal detectada</span>
                <span class="text-xs font-semibold text-red-600">Não</span>
              </div>
              <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <span class="text-xs text-slate-700">Linha horizontal</span>
                <span class="text-xs font-semibold text-red-600">Não</span>
              </div>
              <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <span class="text-xs text-slate-700">Agrupamento</span>
                <span class="text-xs font-semibold text-amber-600">Moderado</span>
              </div>
              <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <span class="text-xs text-slate-700">Distribuição espacial</span>
                <span class="text-xs font-semibold text-green-600">Boa</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nuxt-layout>
</template>