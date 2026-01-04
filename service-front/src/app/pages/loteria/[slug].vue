<template>
  <nuxt-layout name="site-01">
    <template #default="scope">
      <pre>{{ lottoRaffleTypeSelect }}</pre>
    </template>
  </nuxt-layout>
</template>

<script setup>
const route = useRoute();

const lottoRaffleTypeSelect = useAxios({
  method: "get",
  url: `/api/lotto_raffle_type/${route.params.slug}`,
  params: { with: "lastDraw" },
});

lottoRaffleTypeSelect.submit();
</script>
