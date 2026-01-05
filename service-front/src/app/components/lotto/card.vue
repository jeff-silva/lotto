<template>
  <div
    class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-sm"
  >
    <div
      v-if="props.title || props.subtitle"
      class="border-b border-slate-200 dark:border-gray-700 px-6 py-4"
      style="background: linear-gradient(to right, #20986910, transparent)"
    >
      <div class="flex items-center justify-between">
        <div>
          <h2
            v-if="props.title"
            v-html="props.title"
            class="text-lg font-semibold text-slate-900 dark:text-gray-100"
          ></h2>
          <p
            v-if="props.subtitle"
            v-html="props.subtitle"
            class="text-sm text-slate-600 dark:text-gray-300 mt-0.5"
          ></p>
        </div>
        <slot name="header-append"></slot>
      </div>
    </div>

    <div class="px-6 py-8">
      <slot name="default"></slot>
    </div>

    <div
      v-if="slots.footer"
      class="bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-b-md shadow-sm"
    >
      <div
        class="border-t border-slate-200 dark:border-gray-700 px-6 py-4 bg-slate-50 dark:bg-gray-700 flex"
      >
        <slot name="footer"></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  title: { type: String, default: null },
  subtitle: { type: String, default: null },
});

const slots = useSlots();
</script>
