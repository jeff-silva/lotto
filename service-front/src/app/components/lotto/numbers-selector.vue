<template>
  <div>
    <table class="w-full border-collapse">
      <tbody>
        <template v-for="cols in numbers">
          <tr>
            <template v-for="nn in cols">
              <td class="p-1">
                <div
                  class="aspect-square w-full flex items-center justify-center relative"
                >
                  <button
                    :class="[
                      'absolute inset-0 w-full h-full rounded border-2 font-bold text-xs transition-all',
                      nn.selected
                        ? 'text-white hover:opacity-90'
                        : 'border-slate-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-slate-700 dark:text-gray-300 hover:bg-slate-100 dark:hover:bg-gray-700 hover:text-emerald-700 dark:hover:text-emerald-400',
                    ]"
                    :style="
                      nn.selected
                        ? `background: ${color}bb; border-color: ${color};`
                        : ''
                    "
                  >
                    {{ String(nn.number).padStart(2, "0") }}
                  </button>
                </div>
              </td>
            </template>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
  color: { type: String, default: "#000000" },
  numbers: { type: Array, default: [] },
  poolMin: { type: Number, default: 1 },
  poolMax: { type: Number, default: 60 },
  poolCols: { type: Number, default: 10 },
});

const numbers = computed(() => {
  const fullPool = Array.from(
    { length: props.poolMax - props.poolMin + 1 },
    (_, i) => props.poolMin + i
  ).map((number) => {
    const selected = props.numbers.includes(number);
    return { number, selected };
  });

  const chunks = [];
  for (let i = 0; i < fullPool.length; i += props.poolCols) {
    chunks.push(fullPool.slice(i, i + props.poolCols));
  }

  return chunks;
});
</script>
