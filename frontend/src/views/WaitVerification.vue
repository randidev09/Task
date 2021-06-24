<template>
  <div id="login">
    <Navbar />
    <div>You need to verify your email address,<br>please check your email to verify your email address.</div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';

export default {
    name: 'WaitVerification',
    components: {
        Navbar
    },
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
