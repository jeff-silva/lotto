<template>
  <nuxt-layout
    name="site-01"
    @init="onInit"
  >
    <template #default="scope">
      <template v-if="scope.lottoRaffleTypeSelect.response">
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
                :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
              ></div>
              <div class="flex-1">
                <h1 class="text-3xl font-semibold text-slate-900">
                  {{ scope.lottoRaffleTypeSelect.response.entity.name }}
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                  A maior loteria do Brasil com prêmios que podem mudar sua vida
                </p>
              </div>
            </div>
            <nuxt-link
              :to="`/loteria/${scope.route.params.slug}/aposta`"
              class="inline-flex items-center gap-2 rounded px-5 py-2.5 text-white font-semibold text-sm transition-all hover:opacity-90 shadow-sm"
              :style="`background: ${scope.lottoRaffleTypeSelect.response.entity.color};`"
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
};
</script>
