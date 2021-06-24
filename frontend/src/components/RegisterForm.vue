<template>
  <div class="login-form">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6 form-cover">
          <div class="form-group">
              <label for="inputUsername">Username</label>
              <input v-model="username" type="text" class="form-control" placeholder="username" required>
          </div>
          <div class="form-group">
              <label for="inputPassword">Password</label>
              <input v-model="password" type="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group">
              <label for="inputEmail">Email</label>
              <input v-model="email" type="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
              <label for="inputPhone">Phone</label>
              <input v-model="phone" type="text" class="form-control" placeholder="Phone" required>
          </div>
          <button type="submit" class="btn btn-primary mt-4" v-on:click="submitRegister">Register</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'RegisterForm',
  data () {
    return {
      username: null,
      password: null,
      email: null,
      phone: null,
    }
  },
  methods: {
    submitRegister: function() {
      axios.post('http://localhost/api/user',{
        username: this.username,
        password: this.password,
        email: this.email,
        phone: this.phone,
      })
      .then(response => {
        let response_code = response.data.code
        
        if(response_code == 200){
          alert('successfully register !')
          this.$router.push('/wait_verify');
        }else{
          alert('please fill all the column')
        }
      });
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
