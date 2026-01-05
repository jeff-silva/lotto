<template>
  <div
    :class="`border border-${meta.color}-200 dark:border-${meta.color}-700 bg-${meta.color}-50 dark:bg-${meta.color}-900/20 rounded-lg p-4`"
  >
    <div class="flex gap-3">
      <div class="flex-shrink-0">
        <icon
          v-if="meta.icon"
          :name="meta.icon"
          size="20"
          :style="`color: var(--color-${meta.color}-500) !important;`"
        />
      </div>
      <div class="flex-1">
        <p
          v-if="props.title"
          v-html="props.title"
          :class="`text-xs font-semibold text-${meta.color}-900 dark:text-${meta.color}-100 mb-1`"
        ></p>
        <p
          v-if="props.text"
          v-html="props.text"
          :class="`text-xs text-${meta.color}-800 dark:text-${meta.color}-200`"
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

const meta = computed(() => {
  const meta = {
    color: "emerald",
    icon: "material-symbols:check-circle-outline-rounded",
  };

  if (props.type == "warning") {
    meta.color = "amber";
    meta.icon = "typcn:warning-outline";
  } else if (props.type == "info") {
    meta.color = "blue";
    meta.icon = "uil:info-circle";
  } else if (props.type == "error") {
    meta.color = "red";
    meta.icon = "solar:close-circle-outline";
  }

  return meta;
});
</script>
