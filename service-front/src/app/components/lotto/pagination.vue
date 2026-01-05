<template>
  <div
    class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm p-4"
  >
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="text-sm text-slate-600 dark:text-gray-300">
        Mostrando
        <span class="font-medium text-slate-900 dark:text-gray-100">1-10</span>
        de
        <span class="font-medium text-slate-900 dark:text-gray-100">2.650</span>
        concursos
      </div>
      <nav class="flex items-center gap-2">
        <button
          class="px-3 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-400 dark:text-gray-500 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
          disabled
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
              d="M15 19l-7-7 7-7"
            />
          </svg>
        </button>
        <button
          class="px-4 py-2 border-2 rounded-lg text-sm font-medium text-white"
          :style="`background: ${color}; border-color: ${color}`"
        >
          1
        </button>
        <button
          class="px-4 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700"
        >
          2
        </button>
        <button
          class="px-4 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700"
        >
          3
        </button>
        <span class="px-2 text-slate-400 dark:text-gray-500">...</span>
        <button
          class="px-4 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700"
        >
          265
        </button>
        <button
          class="px-3 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-medium text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-700 dark:bg-gray-700"
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
              d="M9 5l7 7-7 7"
            />
          </svg>
        </button>
      </nav>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  color: { type: String, default: "#000000" },
});
</script>
