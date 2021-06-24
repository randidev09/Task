<template>
  <div id="home">
    <Navbar />
    <div v-if="this.$store.state.is_login">
      Welcome {{ this.$store.state.user_name }} !
    </div>
    <div v-else>
      Please login first to see the company list.
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';

export default {
  name: 'Home',
  components: {
    Navbar
  }
}
</script>

<style>
</style>
