// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  devtools: { enabled: true },
  compatibilityDate: "2025-07-15",
  css: ["@/app.css"],

  modules: [
    ["@nuxt/icon", {}],
    ["@nuxt/scripts", {}],
    ["@pinia/nuxt", {}],
  ],

  app: {
    head: {
      script: [{ src: "https://cdn.tailwindcss.com" }],
    },
  },
});
