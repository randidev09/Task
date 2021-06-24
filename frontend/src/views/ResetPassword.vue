<template>
  <div class="reset-form">
      <Navbar />
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6 form-cover">
          <div class="form-group">
              <label>Current Password</label>
              <input v-model="current_password" type="password" class="form-control" placeholder="Current Password">
          </div>
          <div class="form-group">
              <label>New Password</label>
              <input v-model="new_password" type="password" class="form-control" placeholder="New Password">
          </div>
          <div class="form-group">
              <label>Confirm New Password</label>
              <input @keyup="checkConfirm" v-model="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
              <span v-if="doesnt_match" class="text text-warning">This field must be match with new password field</span>
          </div>
          <button type="submit" class="btn btn-primary mt-4" v-on:click="submitReset">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import axios from 'axios';

export default {
  name: 'ResetPassword',
    components: {
    Navbar
    },
  data () {
    return {
      current_password: null,
      confirm_password: null,
      new_password: null,
      doesnt_match: false
    }
  },
  methods: {
    checkConfirm: function(){
        this.doesnt_match = this.confirm_password !== this.new_password
    },
    submitReset: function() {
        if(!this.doesnt_match){
            axios.put('http://localhost/api/password',{
                curpassword: this.current_password,
                newpassword: this.new_password,
                conpassword: this.confirm_password,
                token:this.$store.state.user_token,
                user_id:this.$store.state.user_id
            })
            .then(response => {
                let response_code = response.data.code
                let response_message = response.data.message
                if(response_code == 200){
                    alert(response_message)
                    this.$router.push('/company');
                }else{
                    alert(response_message)
                }
            })
        }
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
