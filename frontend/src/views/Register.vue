<template>
  <div id="login">
    <Navbar />
    <RegisterForm />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import RegisterForm from '@/components/RegisterForm';
import axios from 'axios';

export default {
    name: 'Login',
    components: {
        Navbar,RegisterForm
    },
	mounted () {
        axios
        .get('http://localhost/api/user')
        .then(response => {
            console.log(response)
        })
	},
}
</script>

<style>
</style>
