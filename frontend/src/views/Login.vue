<template>
  <div id="login">
    <Navbar />
    <LoginForm />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import LoginForm from '@/components/LoginForm';

export default {
    name: 'Login',
    components: {
        Navbar,LoginForm
    }
}
</script>

<style>
</style>
