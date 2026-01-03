<template>
  <div>
    <pre>{{ lottoRaffleTypeSearch }}</pre>
  </div>
</template>

<script setup>
const lottoRaffleTypeSearch = useAxios({
  method: "get",
  url: "/api/lotto_raffle_type",
  response: { data: [] },
});

lottoRaffleTypeSearch.submit();
</script>
