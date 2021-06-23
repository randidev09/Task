<template>
  <div id="app">
    <Navbar />
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'App',
  components: {
    Navbar
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
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
