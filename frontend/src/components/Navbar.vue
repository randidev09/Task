<template>
  <div class="navbar mb-5">
    <ul>
      <li v-if="!this.$store.state.is_login">
        <router-link to="/login">Login</router-link>
      </li>
      <li v-if="!this.$store.state.is_login">
        <router-link to="/register">Register</router-link>
      </li>
      <li v-if="this.$store.state.is_login">
        <router-link to="/company">List Company</router-link>
      </li>
      <li v-if="this.$store.state.is_login">
        <router-link to="/favcompany">List Favourite Company</router-link>
      </li>
      <li v-if="this.$store.state.is_login">
        <router-link to="/reset_password">Reset Password</router-link>
      </li>
      <li v-if="this.$store.state.is_login">
        <a v-on:click="logout">Logout</a>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'Navbar',
  methods: {
    logout: function(){
      axios
        .get('http://localhost/api/logout')
        .then(response => {
          if(response.data.code == 200){
            this.$store.commit('logout')
            this.$router.push('/login');
          }
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
  margin-bottom: 0px;
  margin-left: auto;
  margin-right:1em;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #4e4d4d;
  text-decoration: none;
}
.navbar{
  background-color: #efefef;
  box-shadow: 0px 0px 4px 1px #ccc;
}
</style>
