<template>
  <div
    :class="`border border-${color}-200 dark:border-${color}-700 bg-${color}-50 dark:bg-${color}-900/20 rounded-lg p-4`"
  >
    <div class="flex gap-3">
      <div class="flex-shrink-0">
        <icon
          name="mdi:home"
          :style="`color: ${color};`"
        />
        <svg
          :class="`w-5 h-5 text-${color}-600 dark:text-${color}-400`"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
          />
        </svg>
      </div>
      <div class="flex-1">
        <p
          v-if="props.title"
          v-html="props.title"
          :class="`text-xs font-semibold text-${color}-900 dark:text-${color}-100 mb-1`"
        ></p>
        <p
          v-if="props.text"
          v-html="props.text"
          :class="`text-xs text-${color}-800 dark:text-${color}-200`"
        ></p>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  type: { type: String, default: "success" },
  color: { type: String, default: "red" },
  title: { type: String, default: null },
  text: { type: String, default: null },
});

const color = computed(() => {
  if (props.type == "warning") {
    return "#e5e7eb";
  }
  if (props.type == "error") {
    return "#991b1b";
  }
  if (props.type == "info") {
    return "#1e40af";
  }
  return "#047857";
});
</script>
