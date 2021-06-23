<template>
  <div id="login">
    <Navbar />
    <RegisterForm />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import RegisterForm from '@/components/RegisterForm';

export default {
    name: 'Login',
    components: {
        Navbar,RegisterForm
    }
}
</script>

<style>
</style>
