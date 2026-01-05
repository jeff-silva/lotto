import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  devtools: { enabled: true },
  compatibilityDate: "2025-07-15",
  css: ["@/assets/css/tailwind.css"],
  modules: [
    ["@nuxt/icon", {}],
    ["@nuxt/scripts", {}],
    // [
    //   "@nuxtjs/tailwindcss",
    //   {
    //     config: {
    //       darkMode: "class",
    //     },
    //   },
    // ],
    ["@pinia/nuxt", {}],
  ],

  vite: {
    plugins: [tailwindcss()],
  },
});
