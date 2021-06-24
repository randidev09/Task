<template>
  <div id="login">
    <Navbar />
    <div>Successfully verify your email address, please wait you will redirect to login page.</div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import router from "@/router"; 

export default {
    name: 'SuccessVerification',
    components: {
        Navbar
    },
    methods:{
        redirectLogin: function(){
            setTimeout(function () {
                router.push('/login');
            }, 2500);
        }
    },
    mounted () {
        this.redirectLogin();
    }

}
</script>

<style>
ul{
    margin:0px;
}
li{
    list-style: none;
    text-align: left;
}
.toggle-fav{
    cursor: pointer;
    color: #5662ff;
}
</style>
