<template>
  <!-- Container Principal -->
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Overlay para fechar drawer no mobile -->
    <div
      class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden hidden"
      id="drawer-overlay"
    ></div>

    <!-- Drawer Navigation -->
    <!-- Adicionado classes responsivas: hidden lg:flex no desktop, e id para controle mobile -->
    <aside
      class="fixed left-0 top-0 h-full w-72 bg-white shadow-xl flex-col z-50 hidden lg:flex"
      id="drawer-nav"
    >
      <!-- Logo/Header fixo no topo -->
      <div
        class="flex-shrink-0 p-6 bg-gradient-to-r from-emerald-600 to-teal-600"
      >
        <h1 class="text-2xl font-bold text-white">Lotto</h1>
        <p class="text-emerald-50 text-sm mt-1">
          Seus resultados em tempo real
        </p>
      </div>

      <!-- Menu com scroll independente -->
      <nav class="flex-1 overflow-y-auto p-4">
        <!-- Seção: Links Principais -->
        <div class="mb-6">
          <h3
            class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-2"
          >
            Principal
          </h3>

          <nuxt-link
            to="/"
            class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-50 text-emerald-700 font-medium mb-1 transition-all hover:bg-emerald-100"
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
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
              />
            </svg>
            Dashboard
          </nuxt-link>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
              />
            </svg>
            Estatísticas
          </a>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
              />
            </svg>
            Gerar Jogo
          </a>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
            Histórico
          </a>
        </div>

        <!-- Seção: Loterias -->
        <div class="mb-6">
          <h3
            class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-2"
          >
            Loterias
          </h3>

          <template v-for="type in scope.lottoRaffleTypeSearch.response.data">
            <nuxt-link
              :to="`/loteria/${type.slug}`"
              class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
            >
              <div
                class="w-2 h-2 rounded-full"
                :style="{ background: type.color }"
              ></div>
              {{ type.name }}
            </nuxt-link>
          </template>
        </div>

        <!-- Seção: Configurações -->
        <div class="mb-6">
          <h3
            class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-2"
          >
            Configurações
          </h3>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
              />
            </svg>
            Notificações
          </a>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>
            Preferências
          </a>
        </div>

        <!-- Seção: Autenticação -->
        <div class="mb-6">
          <h3
            class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-2"
          >
            Conta
          </h3>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
              />
            </svg>
            Meu Perfil
          </a>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
            Sair
          </a>
        </div>

        <!-- Seção: Ajuda -->
        <div class="mb-4">
          <h3
            class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-2"
          >
            Ajuda
          </h3>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium mb-1 transition-all hover:bg-slate-50"
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
                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
            Central de Ajuda
          </a>

          <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 font-medium transition-all hover:bg-slate-50"
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
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
            Sobre
          </a>
        </div>
      </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <!-- Adicionado padding responsivo e removido margin-left no mobile -->
    <main class="lg:ml-72 p-4 md:p-6 lg:p-8">
      <!-- Header mobile com botão hamburguer -->
      <div class="flex items-center gap-4 mb-6 lg:hidden">
        <button
          id="menu-button"
          class="p-2 rounded-lg hover:bg-white transition-colors"
        >
          <svg
            class="w-6 h-6 text-slate-700"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </button>
        <div>
          <h1 class="text-xl font-bold text-slate-800">Loterias Brasil</h1>
        </div>
      </div>

      <slot v-bind="scope"></slot>
    </main>
  </div>
</template>

<script setup>
const scope = reactive({
  //
});

scope.lottoRaffleTypeSearch = useAxios({
  method: "get",
  url: "/api/lotto_raffle_type",
  params: { order: "order:asc", with: "lastDraw" },
  response: { data: [] },
});

scope.lottoRaffleTypeSearch.submit();
</script>
