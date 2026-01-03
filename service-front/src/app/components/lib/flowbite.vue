<template>
  <slot v-if="lib.ready"></slot>
</template>

<script setup>
const lib = reactive({
  ready: false,
  init() {
    lib.ready = true;
    setTimeout(initFlowbite, 100);
  },
});

onMounted(() => {
  const i = setInterval(() => {
    if (typeof Flowbite == "undefined") return;
    if (typeof initFlowbite == "undefined") return;
    clearInterval(i);
    lib.init();
  }, 100);
});

useHead({
  script: [
    {
      key: "flowbite",
      src: "https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js",
    },
  ],
  link: [
    {
      key: "flowbite",
      rel: "stylesheet",
      href: "https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css",
    },
    {
      key: "flowbite-datepicker",
      rel: "stylesheet",
      href: "https://cdn.jsdelivr.net/npm/flowbite-datepicker/dist/css/datepicker.min.css",
    },
  ],
});
</script>
