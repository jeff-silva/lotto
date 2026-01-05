<script setup lang="ts">
const email = ref("");
const error = ref<string | null>(null);
const isLoading = ref(false);
const success = ref(false);

const supabase = useSupabaseClient();

const handleForgotPassword = async () => {
  error.value = null;
  isLoading.value = true;

  try {
    const { error: supabaseError } = await supabase.auth.resetPasswordForEmail(
      email.value,
      {
        redirectTo: `${window.location.origin}/auth/update-password`,
      }
    );
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
              d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm3 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"
            />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
          Esqueceu sua senha?
        </h1>
        <p class="text-slate-600 dark:text-slate-400">
          Digite seu email para receber instruções de redefinição
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
            <path
              d="M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4M20,18H4V8L12,13L20,8V18M20,6L12,11L4,6V6H20V6Z"
            />
          </svg>
        </div>
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-2">
          Email enviado!
        </h2>
        <p class="text-slate-600 dark:text-slate-400 mb-6">
          Se você tem uma conta conosco, enviamos instruções para redefinir sua
          senha para {{ email }}.
        </p>
        <div class="space-y-3">
          <NuxtLink
            to="/auth"
            class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors text-center"
          >
            Voltar ao Login
          </NuxtLink>
          <button
            @click="
              success = false;
              email = '';
            "
            class="block w-full bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-medium py-2 px-4 rounded-lg transition-colors text-center"
          >
            Enviar outro email
          </button>
        </div>
      </div>

      <!-- Forgot Password Form -->
      <div
        v-else
        class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 p-8"
      >
        <form
          @submit.prevent="handleForgotPassword"
          class="space-y-6"
        >
          <!-- Email Field -->
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2"
            >
              Email
            </label>
            <input
              id="email"
              type="email"
              v-model="email"
              placeholder="seu@email.com"
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

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="isLoading || !email.trim()"
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
              Enviando...
            </span>
            <span v-else>Enviar instruções</span>
          </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-8">
          <p class="text-sm text-slate-600 dark:text-slate-400">
            Lembrou sua senha?
            <NuxtLink
              to="/auth"
              class="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors"
            >
              Fazer login
            </NuxtLink>
          </p>
        </div>
      </div>

      <!-- Help Text -->
      <div class="text-center mt-6">
        <p class="text-xs text-slate-500 dark:text-slate-400">
          Não consegue acessar sua conta?
          <NuxtLink
            to="/auth/register"
            class="text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors"
          >
            Criar uma nova conta
          </NuxtLink>
        </p>
      </div>
    </div>
  </div>
</template>
