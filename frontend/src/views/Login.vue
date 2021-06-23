<template>
  <div id="login">
    <Navbar />
    <LoginForm />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import LoginForm from '@/components/LoginForm';
import axios from 'axios';

export default {
    name: 'Login',
    components: {
        Navbar,LoginForm
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
