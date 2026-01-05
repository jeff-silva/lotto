<template>
  <nuxt-layout
    name="site-01"
    @init="onInit"
  >
    <template #default="scope">
      <template v-if="scope.lottoRaffleTypeSelect.response">
        <div class="max-w-6xl mx-auto space-y-6">
          <div class="flex items-center gap-3">
            <div class="flex items-center gap-3 flex-1">
              <div
                class="w-1 rounded-sm self-stretch"
                :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
              ></div>
              <div class="flex-1">
                <h1
                  class="text-3xl font-semibold text-slate-900 dark:text-gray-100"
                >
                  {{ scope.lottoRaffleTypeSelect.response.entity.name }}
                </h1>
                <p class="text-sm text-slate-500 dark:text-gray-400 mt-1">
                  A maior loteria do Brasil com prêmios que podem mudar sua vida
                </p>
              </div>
            </div>
          </div>

          <!-- Tabs Navigation -->
          <div class="border-slate-200 dark:border-gray-700">
            <nav class="flex gap-3">
              <template v-for="tab in scope.tabs">
                <nuxt-link
                  :to="tab.to"
                  :class="[
                    'p-3 text-sm text-white font-medium border-b-2 transition-colors rounded-t-md',
                    tab.active
                      ? 'border-current'
                      : 'border-transparent text-slate-500 dark:text-gray-400 hover:text-slate-700 dark:hover:text-gray-400 dark:hover:text-gray-400 hover:border-slate-300 dark:hover:border-gray-500',
                  ]"
                  :style="
                    tab.active
                      ? `background: ${scope.lottoRaffleTypeSelect.response.entity.color}aa;`
                      : ''
                  "
                >
                  {{ tab.name }}
                </nuxt-link>
              </template>
            </nav>
          </div>

          <nuxt-page :scope="scope" />
        </div>
      </template>
    </template>
  </nuxt-layout>
</template>

<script setup>
const onInit = (scope) => {
  scope.route = useRoute();

  scope.lottoRaffleTypeSelect = useAxios({
    method: "get",
    url: `/api/lotto_raffle_type/${scope.route.params.slug}`,
    params: { with: "lastDraw" },
  });

  scope.lottoRaffleTypeSelect.submit();

  scope.tabs = computed(() => {
    return [
      {
        name: "Último resultado",
        to: `/loteria/${scope.route.params.slug}`,
        active: scope.route.path.split("/").at(3) == undefined,
      },
      {
        name: "Sorteios",
        to: `/loteria/${scope.route.params.slug}/sorteios`,
        active: scope.route.path.split("/").at(3) == "sorteios",
      },
      {
        name: "Analisar aposta",
        to: `/loteria/${scope.route.params.slug}/aposta`,
        active: scope.route.path.split("/").at(3) == "aposta",
      },
    ];
  });
};
</script>
