<template>
  <div class="max-w-7xl mx-auto space-y-6">
    <div class="bg-white border border-slate-200 rounded-md shadow-sm">
      <div
        class="border-b border-slate-200 px-6 py-4"
        style="background: linear-gradient(to right, #20986910, transparent)"
      >
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900">Sorteios</h2>
            <p class="text-sm text-slate-600 mt-0.5">Ver todos os sorteios</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  scope: { type: Object, default: () => ({}) },
});
</script>
