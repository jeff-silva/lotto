<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});

const route = useRoute();
</script>

<template>
  <div
    v-if="scope.lottoRaffleDrawSelect?.response?.entity"
    class="mx-auto space-y-6"
  >
    <lotto-card
      title="Último Sorteio"
      :subtitle="`Concurso ${scope.lottoRaffleDrawSelect.response.entity.number}`"
    >
      <template #default>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Seletor de Números -->
          <div class="lg:col-span-2">
            <lotto-numbers-selector
              v-bind="{
                numbers: scope.lottoRaffleDrawSelect.response.entity.result,
                color: scope.lottoRaffleTypeSelect.response.entity.color,
                poolMin: scope.lottoRaffleTypeSelect.response.entity.pool_min,
                poolMax: scope.lottoRaffleTypeSelect.response.entity.pool_max,
                poolCols: scope.lottoRaffleTypeSelect.response.entity.pool_cols,
              }"
            />

            <div class="flex justify-end gap-3 mt-3">
              <button
                v-if="scope.lottoRaffleDrawSelect.response.entity.prev"
                type="button"
                class="bg-transparent border font-medium py-2 px-4 rounded-md shadow-sm transition duration-200 ease-in-out"
                :style="[
                  `border-color: ${scope.lottoRaffleTypeSelect.response.entity.color} !important;`,
                  `color: ${scope.lottoRaffleTypeSelect.response.entity.color} !important;`,
                ]"
                @click="
                  scope.lottoRaffleDrawSelect.goto(
                    scope.lottoRaffleDrawSelect.response.entity.prev.id
                  )
                "
              >
                <span>&larr;</span>
                {{ scope.lottoRaffleDrawSelect.response.entity.prev.number }}
              </button>
              <button
                v-if="scope.lottoRaffleDrawSelect.response.entity.next"
                type="button"
                class="bg-transparent border font-medium py-2 px-4 rounded-md shadow-sm transition duration-200 ease-in-out"
                :style="[
                  `border-color: ${scope.lottoRaffleTypeSelect.response.entity.color} !important;`,
                  `color: ${scope.lottoRaffleTypeSelect.response.entity.color} !important;`,
                ]"
                @click="
                  scope.lottoRaffleDrawSelect.goto(
                    scope.lottoRaffleDrawSelect.response.entity.next.id
                  )
                "
              >
                {{ scope.lottoRaffleDrawSelect.response.entity.next.number }}
                <span>&rarr;</span>
              </button>
            </div>
          </div>

          <div class="border border-slate-900">
            <div>&nbsp;</div>
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

    <lotto-numbers-analisys
      :type-id="scope.lottoRaffleTypeSelect.response.entity.id"
      :numbers="scope.lottoRaffleDrawSelect.response.entity.result"
    />
  </div>
</template>
