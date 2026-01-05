<script setup lang="ts">
const password = ref("");
const confirmPassword = ref("");
const error = ref<string | null>(null);
const isLoading = ref(false);
const success = ref(false);

const supabase = useSupabaseClient();

const handleUpdatePassword = async () => {
  error.value = null;

  if (password.value !== confirmPassword.value) {
    error.value = "As senhas não coincidem";
    return;
  }

  if (password.value.length < 6) {
    error.value = "A senha deve ter pelo menos 6 caracteres";
    return;
  }

  isLoading.value = true;

  try {
    const { error: supabaseError } = await supabase.auth.updateUser({
      password: password.value,
    });
    if (supabaseError) throw supabaseError;
    success.value = true;
  } catch (err: unknown) {
    error.value = err instanceof Error ? err.message : "Ocorreu um erro";
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 flex items-center justify-center p-4"
  >
    <div class="w-full max-w-md">
      <!-- Logo/Brand Section -->
      <div class="text-center mb-8">
        <div
          class="w-16 h-16 bg-emerald-500 rounded-full mx-auto mb-4 flex items-center justify-center"
        >
          <svg
            class="w-8 h-8 text-white"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,3.18L19,6.3V11.22C19,12.91 18.45,14.56 17.4,16.03C15.9,17.96 13.6,19.27 12,19.92C10.4,19.27 8.1,17.96 6.6,16.03C5.55,14.56 5,12.91 5,11.22V6.3L12,3.18M12,7C10.34,7 9,8.34 9,10C9,11.66 10.34,13 12,13C13.66,13 15,11.66 15,10C15,8.34 13.66,7 12,7M12,9C12.55,9 13,9.45 13,10C13,10.55 12.55,11 12,11C11.45,11 11,10.55 11,10C11,9.45 11.45,9 12,9Z"
            />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
          Nova Senha
        </h1>
        <p class="text-slate-600 dark:text-slate-400">
          Digite sua nova senha para continuar
        </p>
      </div>

      <!-- Success Message -->
      <div
        v-if="success"
        class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 p-8 text-center"
      >
        <div
          class="w-16 h-16 bg-green-100 dark:bg-green-900/20 rounded-full mx-auto mb-4 flex items-center justify-center"
        >
          <svg
            class="w-8 h-8 text-green-600 dark:text-green-400"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
          </svg>
        </div>
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-2">
          Senha atualizada!
        </h2>
        <p class="text-slate-600 dark:text-slate-400 mb-6">
          Sua senha foi alterada com sucesso. Você pode fazer login agora.
        </p>
        <NuxtLink
          to="/auth"
          class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
        >
          Fazer Login
        </NuxtLink>
      </div>

      <!-- Update Password Form -->
      <div
        v-else
        class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 p-8"
      >
        <form
          @submit.prevent="handleUpdatePassword"
          class="space-y-6"
        >
          <!-- New Password Field -->
          <div>
            <label
              for="password"
              class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2"
            >
              Nova Senha
            </label>
            <input
              id="password"
              type="password"
              v-model="password"
              placeholder="••••••••"
              required
              minlength="6"
              class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
            />
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
              Mínimo 6 caracteres
            </p>
          </div>

          <!-- Confirm Password Field -->
          <div>
            <label
              for="confirmPassword"
              class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2"
            >
              Confirmar Nova Senha
            </label>
            <input
              id="confirmPassword"
              type="password"
              v-model="confirmPassword"
              placeholder="••••••••"
              required
              class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
            />
          </div>

          <!-- Error Message -->
          <div
            v-if="error"
            class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg"
          >
            <p class="text-sm text-red-600 dark:text-red-400">{{ error }}</p>
          </div>

          <!-- Update Button -->
          <button
            type="submit"
            :disabled="isLoading || !password.trim() || !confirmPassword.trim()"
            class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 disabled:cursor-not-allowed text-white font-semibold py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
          >
            <span
              v-if="isLoading"
              class="flex items-center justify-center"
            >
              <svg
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle
                  class="opacity-25"
                  cx="12"
                  cy="12"
                  r="10"
                  stroke="currentColor"
                  stroke-width="4"
                ></circle>
                <path
                  class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
              </svg>
              Atualizando...
            </span>
            <span v-else>Atualizar Senha</span>
          </button>
        </form>

        <!-- Help Text -->
        <div class="text-center mt-8">
          <p class="text-sm text-slate-600 dark:text-slate-400">
            Problemas com o link?
            <NuxtLink
              to="/auth/forget"
              class="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors"
            >
              Solicitar novo link
            </NuxtLink>
          </p>
        </div>
      </div>

      <!-- Security Notice -->
      <div class="text-center mt-6">
        <p class="text-xs text-slate-500 dark:text-slate-400">
          🔒 Sua senha é criptografada e armazenada com segurança
        </p>
      </div>
    </div>
  </div>
</template>
