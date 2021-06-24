<template>
  <div class="login-form">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6 form-cover">
          <div class="form-group">
              <label for="inputUsername">Username</label>
              <input v-model="username" type="text" class="form-control" placeholder="username">
          </div>
          <div class="form-group">
              <label for="inputPassword">Password</label>
              <input v-model="password" type="password" class="form-control" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary mt-4" v-on:click="submitLogin">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'LoginForm',
  data () {
    return {
      username: null,
      password: null
    }
  },
  methods: {
    submitLogin: function() {
      axios.post('http://localhost/api/login',{
        username: this.username,
        password: this.password
      })
      .then(response => {
        let response_code = response.data.code
        if(response_code == 200){
          const thisUser = {
            user_id: response.data.user.id,
            user_name: response.data.user.username,
            token: response.data.user.token_auth
          }
          this.$store.commit('loginUpdate',thisUser)
          this.$router.push('/company');
        }else{
          alert('Username / password is wrong.')
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
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #333;
  text-decoration: none;
}
.form-cover{
  margin: 0 auto;
  text-align: left;
}
.form-group:not(:first-child){
  margin-top:1em;
}
</style>
