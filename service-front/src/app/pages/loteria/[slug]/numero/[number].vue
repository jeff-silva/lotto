<template>
  <div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-3 flex-1">
        <div
          class="w-16 h-16 rounded flex items-center justify-center text-2xl font-bold text-white shadow-md"
          :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
        >
          {{ scope.route.params.number }}
        </div>
        <div>
          <h1 class="text-3xl font-semibold text-slate-900">
            Análise do Número {{ scope.route.params.number }}
          </h1>
          <p class="text-sm text-slate-500 mt-1">
            {{ scope.lottoRaffleTypeSelect.response.entity.name }} •
            Estatísticas completas e tendências
          </p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
        <p class="text-xs text-slate-500 mb-1">Total de Sorteios</p>
        <p
          class="text-3xl font-bold"
          style="color: #209869"
        >
          127
        </p>
        <p class="text-xs text-slate-500 mt-1">em 2.650 concursos (4.79%)</p>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
        <p class="text-xs text-slate-500 mb-1">Último Sorteio</p>
        <p class="text-3xl font-bold text-slate-900">3</p>
        <p class="text-xs text-slate-500 mt-1">concursos atrás</p>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
        <p class="text-xs text-slate-500 mb-1">Maior Atraso</p>
        <p class="text-3xl font-bold text-slate-900">47</p>
        <p class="text-xs text-slate-500 mt-1">concursos consecutivos</p>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm p-4">
        <p class="text-xs text-slate-500 mb-1">Atraso Atual</p>
        <p class="text-3xl font-bold text-orange-600">3</p>
        <p class="text-xs text-slate-500 mt-1">concursos</p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white border border-slate-200 rounded-md shadow-sm">
        <div class="px-5 py-4 border-b border-slate-200">
          <h3 class="text-base font-semibold text-slate-900">
            Frequência por Período
          </h3>
          <p class="text-xs text-slate-500 mt-0.5">
            Evolução mensal dos sorteios
          </p>
        </div>
        <div class="p-5">
          <div class="space-y-3">
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Jan/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >8 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 80%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Fev/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >5 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 50%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Mar/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >12 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 100%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Abr/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >3 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 30%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Mai/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >9 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 90%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">Jun/24</span>
                <span class="text-xs font-semibold text-slate-900"
                  >7 sorteios</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 70%; background: #209869"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm">
        <div class="px-5 py-4 border-b border-slate-200">
          <h3 class="text-base font-semibold text-slate-900">
            Distribuição por Década
          </h3>
          <p class="text-xs text-slate-500 mt-0.5">Comparativo de frequência</p>
        </div>
        <div class="p-5">
          <div class="flex items-end justify-between gap-2 h-48">
            <div class="flex-1 flex flex-col items-center gap-2">
              <div class="w-full bg-slate-100 rounded-sm relative h-full">
                <div
                  class="absolute bottom-0 w-full rounded-sm"
                  style="height: 45%; background: #20986950"
                ></div>
              </div>
              <div class="text-center">
                <p class="text-xs font-semibold text-slate-900">23</p>
                <p class="text-xs text-slate-500">2000s</p>
              </div>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2">
              <div class="w-full bg-slate-100 rounded-sm relative h-full">
                <div
                  class="absolute bottom-0 w-full rounded-sm"
                  style="height: 78%; background: #209869"
                ></div>
              </div>
              <div class="text-center">
                <p class="text-xs font-semibold text-slate-900">41</p>
                <p class="text-xs text-slate-500">2010s</p>
              </div>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2">
              <div class="w-full bg-slate-100 rounded-sm relative h-full">
                <div
                  class="absolute bottom-0 w-full rounded-sm"
                  style="height: 100%; background: #209869"
                ></div>
              </div>
              <div class="text-center">
                <p class="text-xs font-semibold text-slate-900">63</p>
                <p class="text-xs text-slate-500">2020s</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-md shadow-sm">
      <div class="px-5 py-4 border-b border-slate-200">
        <h3 class="text-base font-semibold text-slate-900">
          Números mais Sorteados em Conjunto
        </h3>
        <p class="text-xs text-slate-500 mt-0.5">
          Top 10 combinações com o número {{ scope.route.params.number }}
        </p>
      </div>
      <div class="p-5">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
          <div
            class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200"
          >
            <div
              class="w-10 h-10 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
              style="background: #209869"
            >
              23
            </div>
            <div>
              <p class="text-xs text-slate-500">Frequência</p>
              <p class="text-sm font-semibold text-slate-900">18x</p>
            </div>
          </div>
          <div
            class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200"
          >
            <div
              class="w-10 h-10 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
              style="background: #209869"
            >
              42
            </div>
            <div>
              <p class="text-xs text-slate-500">Frequência</p>
              <p class="text-sm font-semibold text-slate-900">15x</p>
            </div>
          </div>
          <div
            class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200"
          >
            <div
              class="w-10 h-10 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
              style="background: #209869"
            >
              07
            </div>
            <div>
              <p class="text-xs text-slate-500">Frequência</p>
              <p class="text-sm font-semibold text-slate-900">14x</p>
            </div>
          </div>
          <div
            class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200"
          >
            <div
              class="w-10 h-10 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
              style="background: #209869"
            >
              58
            </div>
            <div>
              <p class="text-xs text-slate-500">Frequência</p>
              <p class="text-sm font-semibold text-slate-900">13x</p>
            </div>
          </div>
          <div
            class="flex items-center gap-3 p-3 bg-slate-50 rounded border border-slate-200"
          >
            <div
              class="w-10 h-10 rounded flex items-center justify-center text-sm font-bold text-white shadow-sm"
              style="background: #209869"
            >
              11
            </div>
            <div>
              <p class="text-xs text-slate-500">Frequência</p>
              <p class="text-sm font-semibold text-slate-900">12x</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white border border-slate-200 rounded-md shadow-sm">
        <div class="px-5 py-4 border-b border-slate-200">
          <h3 class="text-base font-semibold text-slate-900">
            Análise de Atrasos
          </h3>
          <p class="text-xs text-slate-500 mt-0.5">
            Histórico dos últimos 10 sorteios
          </p>
        </div>
        <div class="p-5">
          <div class="space-y-2">
            <div class="flex items-center gap-2">
              <span class="text-xs text-slate-500 w-20">Concurso 2647</span>
              <div class="flex-1 bg-slate-100 rounded-sm h-6 relative">
                <div
                  class="absolute left-0 top-0 h-full rounded-sm flex items-center justify-end pr-2"
                  style="width: 15%; background: #20986930"
                >
                  <span class="text-xs font-semibold text-slate-700">3</span>
                </div>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs text-slate-500 w-20">Concurso 2640</span>
              <div class="flex-1 bg-slate-100 rounded-sm h-6 relative">
                <div
                  class="absolute left-0 top-0 h-full rounded-sm flex items-center justify-end pr-2"
                  style="width: 45%; background: #20986950"
                >
                  <span class="text-xs font-semibold text-slate-700">12</span>
                </div>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs text-slate-500 w-20">Concurso 2628</span>
              <div class="flex-1 bg-slate-100 rounded-sm h-6 relative">
                <div
                  class="absolute left-0 top-0 h-full rounded-sm flex items-center justify-end pr-2"
                  style="width: 25%; background: #20986940"
                >
                  <span class="text-xs font-semibold text-slate-700">7</span>
                </div>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs text-slate-500 w-20">Concurso 2621</span>
              <div class="flex-1 bg-slate-100 rounded-sm h-6 relative">
                <div
                  class="absolute left-0 top-0 h-full rounded-sm flex items-center justify-end pr-2"
                  style="width: 85%; background: #209869"
                >
                  <span class="text-xs font-semibold text-white">28</span>
                </div>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs text-slate-500 w-20">Concurso 2593</span>
              <div class="flex-1 bg-slate-100 rounded-sm h-6 relative">
                <div
                  class="absolute left-0 top-0 h-full rounded-sm flex items-center justify-end pr-2"
                  style="width: 10%; background: #20986920"
                >
                  <span class="text-xs font-semibold text-slate-700">2</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white border border-slate-200 rounded-md shadow-sm">
        <div class="px-5 py-4 border-b border-slate-200">
          <h3 class="text-base font-semibold text-slate-900">
            Padrão de Repetição
          </h3>
          <p class="text-xs text-slate-500 mt-0.5">Intervalo entre sorteios</p>
        </div>
        <div class="p-5">
          <div class="space-y-3">
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">0-5 concursos</span>
                <span class="text-xs font-semibold text-slate-900"
                  >35 vezes</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 70%; background: #209869"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">6-10 concursos</span>
                <span class="text-xs font-semibold text-slate-900"
                  >28 vezes</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 56%; background: #20986980"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">11-20 concursos</span>
                <span class="text-xs font-semibold text-slate-900"
                  >18 vezes</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 36%; background: #20986960"
                ></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs text-slate-600">21+ concursos</span>
                <span class="text-xs font-semibold text-slate-900"
                  >12 vezes</span
                >
              </div>
              <div class="w-full bg-slate-100 rounded-sm h-2">
                <div
                  class="h-2 rounded-sm"
                  style="width: 24%; background: #20986940"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-md shadow-sm">
      <div class="px-5 py-4 border-b border-slate-200">
        <h3 class="text-base font-semibold text-slate-900">
          Histórico Completo
        </h3>
        <p class="text-xs text-slate-500 mt-0.5">
          Últimos 20 sorteios do número {{ scope.route.params.number }}
        </p>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
              <th
                class="px-5 py-3 text-left text-xs font-semibold text-slate-600"
              >
                Concurso
              </th>
              <th
                class="px-5 py-3 text-left text-xs font-semibold text-slate-600"
              >
                Data
              </th>
              <th
                class="px-5 py-3 text-left text-xs font-semibold text-slate-600"
              >
                Números Sorteados
              </th>
              <th
                class="px-5 py-3 text-left text-xs font-semibold text-slate-600"
              >
                Atraso
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr class="hover:bg-slate-50 transition">
              <td class="px-5 py-3 text-sm font-medium text-slate-900">2650</td>
              <td class="px-5 py-3 text-sm text-slate-600">28/12/2024</td>
              <td class="px-5 py-3">
                <div class="flex gap-1">
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >05</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >12</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >23</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >34</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >47</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >58</span
                  >
                </div>
              </td>
              <td class="px-5 py-3 text-sm text-slate-600">3 concursos</td>
            </tr>
            <tr class="hover:bg-slate-50 transition">
              <td class="px-5 py-3 text-sm font-medium text-slate-900">2647</td>
              <td class="px-5 py-3 text-sm text-slate-600">21/12/2024</td>
              <td class="px-5 py-3">
                <div class="flex gap-1">
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >03</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >05</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >18</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >29</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >41</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >56</span
                  >
                </div>
              </td>
              <td class="px-5 py-3 text-sm text-slate-600">12 concursos</td>
            </tr>
            <tr class="hover:bg-slate-50 transition">
              <td class="px-5 py-3 text-sm font-medium text-slate-900">2635</td>
              <td class="px-5 py-3 text-sm text-slate-600">08/12/2024</td>
              <td class="px-5 py-3">
                <div class="flex gap-1">
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >05</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >14</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >27</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >38</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >49</span
                  >
                  <span
                    class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold text-white"
                    style="background: #209869"
                    >60</span
                  >
                </div>
              </td>
              <td class="px-5 py-3 text-sm text-slate-600">7 concursos</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});
</script>
